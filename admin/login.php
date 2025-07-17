session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login-form.php");
  exit;
}