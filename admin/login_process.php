<?php
// Start secure session
session_start([
    'cookie_lifetime' => 86400, // 1 day
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
    'use_strict_mode' => true
]);

require 'koneksi.php';

/**
 * Validate CSRF token
 */
function validateCsrfToken() {
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || 
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        header("Location: login.php?error=invalid_csrf");
        exit();
    }
}

/**
 * Rate limiting protection
 */
function enforceRateLimiting() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $rateLimitKey = 'login_attempt_' . $ip;
    $currentTime = time();
    
    // Initialize rate limiting if not set
    if (!isset($_SESSION[$rateLimitKey])) {
        $_SESSION[$rateLimitKey] = [
            'attempts' => 0,
            'last_attempt' => $currentTime
        ];
    }
    
    // Reset counter if last attempt was more than 5 minutes ago
    if ($currentTime - $_SESSION[$rateLimitKey]['last_attempt'] > 300) {
        $_SESSION[$rateLimitKey] = [
            'attempts' => 0,
            'last_attempt' => $currentTime
        ];
    }
    
    // Check if exceeded maximum attempts
    if ($_SESSION[$rateLimitKey]['attempts'] >= 5) {
        header("Location: login.php?error=rate_limit_exceeded");
        exit();
    }
}

/**
 * Validate user credentials
 */
function validateCredentials($conn, $username, $password) {
    $stmt = null;
    $updateStmt = null;
    
    try {
        // Prepare statement with error handling
        $stmt = $conn->prepare("SELECT id, username, password, full_name, role, is_active FROM admin_users WHERE username = ? LIMIT 1");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        // Bind parameters and execute
        if (!$stmt->bind_param("s", $username) || !$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        // Check if user exists
        if ($result->num_rows !== 1) {
            return ['success' => false, 'error' => 'user_not_found'];
        }
        
        $user = $result->fetch_assoc();
        
        // Check if account is active
        if (!$user['is_active']) {
            return ['success' => false, 'error' => 'account_inactive'];
        }
        
        // Verify password with timing attack protection
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'error' => 'invalid_credentials'];
        }
        
        return ['success' => true, 'user' => $user];
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        return ['success' => false, 'error' => 'database_error'];
    } finally {
        if ($stmt) {
            $stmt->close();
        }
    }
}

/**
 * Set remember me cookie
 */
function setRememberMeCookie($conn, $userId) {
    $token = bin2hex(random_bytes(32));
    $expiry = time() + 86400 * 30; // 30 days
    
    // Secure cookie settings
    setcookie('remember_token', $token, [
        'expires' => $expiry,
        'path' => '/',
        'domain' => '',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    // Store token in database
    $updateStmt = null;
    try {
        $updateStmt = $conn->prepare("UPDATE admin_users SET remember_token = ?, token_expiry = ? WHERE id = ?");
        if ($updateStmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $expiryDate = date('Y-m-d H:i:s', $expiry);
        if (!$updateStmt->bind_param("ssi", $token, $expiryDate, $userId) || !$updateStmt->execute()) {
            throw new Exception("Execute failed: " . $updateStmt->error);
        }
        
        return true;
    } catch (Exception $e) {
        error_log("Remember me error: " . $e->getMessage());
        return false;
    } finally {
        if ($updateStmt) {
            $updateStmt->close();
        }
    }
}

/**
 * Update login information
 */
function updateLoginInfo($conn, $userId) {
    $updateStmt = null;
    try {
        $updateStmt = $conn->prepare("UPDATE admin_users SET last_login = NOW(), login_ip = ? WHERE id = ?");
        if ($updateStmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!$updateStmt->bind_param("si", $ip, $userId) || !$updateStmt->execute()) {
            throw new Exception("Execute failed: " . $updateStmt->error);
        }
        
        return true;
    } catch (Exception $e) {
        error_log("Login info update error: " . $e->getMessage());
        return false;
    } finally {
        if ($updateStmt) {
            $updateStmt->close();
        }
    }
}

/**
 * Main login processing
 */
function processLogin($conn) {
    // Validate CSRF token
    validateCsrfToken();
    
    // Enforce rate limiting
    enforceRateLimiting();
    
    // Validate request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: login.php?error=invalid_method");
        exit();
    }
    
    // Sanitize and validate inputs
    $username = trim($conn->real_escape_string($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty_fields");
        exit();
    }
    
    // Validate credentials
    $authResult = validateCredentials($conn, $username, $password);
    
    if (!$authResult['success']) {
        // Increment failed attempt counter
        $rateLimitKey = 'login_attempt_' . $_SERVER['REMOTE_ADDR'];
        $_SESSION[$rateLimitKey]['attempts']++;
        $_SESSION[$rateLimitKey]['last_attempt'] = time();
        
        header("Location: login.php?error=" . $authResult['error']);
        exit();
    }
    
    $user = $authResult['user'];
    
    // Regenerate session ID to prevent session fixation
    session_regenerate_id(true);
    
    // Set session variables
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['admin_username'] = $user['username'];
    $_SESSION['admin_fullname'] = $user['full_name'];
    $_SESSION['admin_role'] = $user['role'];
    $_SESSION['last_activity'] = time();
    
    // Set remember me cookie if requested
    if ($remember) {
        setRememberMeCookie($conn, $user['id']);
    }
    
    // Update login info
    updateLoginInfo($conn, $user['id']);
    
    // Reset rate limit counter
    unset($_SESSION['login_attempt_' . $_SERVER['REMOTE_ADDR']]);
    
    // Redirect to dashboard
    header("Location: index.php");
    exit();
}

// Execute login process
processLogin($conn);