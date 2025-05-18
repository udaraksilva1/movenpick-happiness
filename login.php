<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['employee_id'];
    $name = $_POST['employee_name'];
    $lang = $_POST['lang'] ?? 'en';

    try {
        $db = new PDO('sqlite:employees.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM employees WHERE employee_id = ? AND name = ?");
        $stmt->execute([$id, $name]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['employee_id'] = $id;
            $_SESSION['lang'] = $lang;
            header("Location: vote.html");
            exit;
        } else {
            $error = "Invalid Employee ID or Name.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mövenpick Login</title>
  <style>
  body {
    max-width: 360px;
    height: 780px;
    margin: 0 auto;
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }
  img.logo {
    display: block;
    max-width: 80%;
    height: auto;
    margin: 20px auto;
  }

  body {
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    background-color: #f2f2f2;
  }

    body {
      max-width: 360px;
      height: 780px;
      margin: 0 auto;
      background-color: #f2f2f2;
      text-align: center;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px;
    }
    img.logo {
      width: 150px;
      margin-bottom: 20px;
    }
    form {
      background: white;
      padding: 20px;
      display: inline-block;
      border-radius: 10px;
      box-shadow: 0 0 10px #aaa;
    }
    input, select {
      padding: 10px;
      margin: 10px;
      width: 250px;
      font-size: 16px;
    }
    .btn {
      background-color: #b4512b;
      color: white;
      border: none;
      cursor: pointer;
      padding: 10px 30px;
      font-size: 16px;
      border-radius: 20px;
    }
    .error { color: red; margin-top: 10px; }
  </style>

  <link rel="manifest" href="manifest.json" />
  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('service-worker.js');
    }
  </script>
  <style>
  body {
    max-width: 360px;
    height: 780px;
    margin: 0 auto;
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }
  img.logo {
    display: block;
    max-width: 80%;
    height: auto;
    margin: 20px auto;
  }

  body {
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    background-color: #f2f2f2;
  }

    body.dark-mode {
      background-color: #121212;
      color: white;
    }
    body.dark-mode input, body.dark-mode select {
      background-color: #333;
      color: white;
    }
  </style>

  <link rel="manifest" href="manifest.json" />
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('service-worker.js');
    }
  </script>
  <style>
  body {
    max-width: 360px;
    height: 780px;
    margin: 0 auto;
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }
  img.logo {
    display: block;
    max-width: 80%;
    height: auto;
    margin: 20px auto;
  }

  body {
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    background-color: #f2f2f2;
  }

    body.dark-mode {
      background-color: #121212;
      color: white;
    }
    body.dark-mode input, body.dark-mode select {
      background-color: #333;
      color: white;
    }
  </style>
</head>
<body>

<audio autoplay loop muted playsinline>
  <source src="audio/background.mp3" type="audio/mpeg">
</audio>

  <img src="Logo.jpg" class="logo" alt="Mövenpick Logo"/>
  <h2>Mövenpick Happiness Meter</h2>
  <form method="POST" action="login.php">
    <input type="text" name="employee_id" placeholder="Employee ID" required /><br>
    <input type="text" name="employee_name" placeholder="Employee Name" required /><br>
    <select name="lang">
      <option value="en">English</option>
      <option value="si">සිංහල</option>
      <option value="ta">தமிழ்</option>
      <option value="ru">Русский</option>
      <option value="ur">اردو</option>
      <option value="ps">پښتو</option>
      <option value="my">မြန်မာ</option>
      <option value="ml">മലയാളം</option>
      <option value="gaa">Ghanaian</option>
    </select><br>
    <button type="submit" class="btn">Login</button>
    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
  
    <br>
    <label>
      <input type="checkbox" onclick="toggleDark()"> Dark Mode
    </label>
    <script>
      function toggleDark() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('dark', document.body.classList.contains('dark-mode'));
      }
      if (localStorage.getItem('dark') === 'true') {
        document.body.classList.add('dark-mode');
      }
    </script>
</form>
</body>
</html>
