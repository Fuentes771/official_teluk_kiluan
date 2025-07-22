<?php
session_start();
require 'koneksi.php';

// Validate CSRF token
if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    header("Location: login.php?error=access_denied");
    exit();
}

// Rate limiting - allow max 5 attempts in 5 minutes
$rateLimitKey = 'login_attempt_' . $_SERVER['REMOTE_ADDR'];
$attempts = $_SESSION[$rateLimitKey] ?? 0;

if ($attempts >= 5) {
    header("Location: login.php?error=rate_limit");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $username = trim($conn->real_escape_string($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=invalid_credentials");
        exit();
    }

    // Prepare statement with error handling
    try {
        $stmt = $conn->prepare("SELECT id, username, password, full_name, role, is_active FROM admin_users WHERE username = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Check if account is active
            if (!$user['is_active']) {
                header("Location: login.php?error=account_inactive");
                exit();
            }

            // Verify password with timing attack protection
            if (password_verify($password, $user['password'])) {
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
                    $token = bin2hex(random_bytes(32));
                    $expiry = time() + 86400 * 30; // 30 days
                    
                    setcookie('remember_token', $token, $expiry, '/', '', true, true);
                    
                    // Store token in database
                    $updateStmt = $conn->prepare("UPDATE admin_users SET remember_token = ?, token_expiry = ? WHERE id = ?");
                    $updateStmt->bind_param("ssi", $token, date('Y-m-d H:i:s', $expiry), $user['id']);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
                
                // Update last login time
                $updateStmt = $conn->prepare("UPDATE admin_users SET last_login = NOW(), login_ip = ? WHERE id = ?");
                $updateStmt->bind_param("si", $_SERVER['REMOTE_ADDR'], $user['id']);
                $updateStmt->execute();
                $updateStmt->close();
                
                // Reset rate limit counter
                unset($_SESSION[$rateLimitKey]);
                
                // Redirect to dashboard
                header("Location: index.php");
                exit();
            } else {
                // Increment failed attempt counter
                $_SESSION[$rateLimitKey] = $attempts + 1;
                header("Location: login.php?error=invalid_credentials");
                exit();
            }
        } else {
            // User not found
            $_SESSION[$rateLimitKey] = $attempts + 1;
            header("Location: login.php?error=user_not_found");
            exit();
        }
        
        $stmt->close();
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        header("Location: login.php?error=server_error");
        exit();
    }
} else {
    // Not a POST request
    header("Location: login.php");
    exit();
}
?>