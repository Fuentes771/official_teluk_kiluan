<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - Teluk Kiluan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #83a4d4, #b6fbff);
      height: 100vh;
    }
    .login-box {
      margin-top: 100px;
      padding: 30px;
      background: white;
      border-radius: 15px;
      box-shadow: 0px 10px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center">
    <div class="col-md-4 login-box">
      <h3 class="text-center mb-4">Admin Login</h3>
      <form action="dashboard.php" method="POST">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>
    </div>
  </div>
</body>
</html>