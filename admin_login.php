<?php
session_start();
$admin_password = "Movenpick@2025";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Incorrect password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    body {
      max-width: 360px;
      height: 780px;
      margin: 0 auto;
      background: url('background.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
      padding: 30px;
    }
    input {
      padding: 10px;
      width: 80%;
      margin: 15px 0;
    }
    .btn {
      background-color: #b4512b;
      color: white;
      border: none;
      padding: 10px 30px;
      border-radius: 20px;
      cursor: pointer;
    }
    .error { color: red; }
  </style>
</head>
<body>
  <img src="Logo.jpg" class="logo" style="max-width: 80%; margin: 20px auto;">
  <h2>Admin Login</h2>
  <form method="POST">
    <input type="password" name="password" placeholder="Enter Password" required />
    <br>
    <button class="btn" type="submit">Login</button>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
  </form>
</body>
</html>
