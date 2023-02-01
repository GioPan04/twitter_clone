<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  include "../lib/db.php";
  include "../lib/auth.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
  $user = login($username, $password);

  if($user) {
    session_start();
    $_SESSION['user'] = $user;
    header('Location: /');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Twitter - Login</title>
  <link rel="stylesheet" href="/static/style.css">
</head>
<body class="center">
  <div>
    <form class="login-form" action="login.php" method="POST">
      <img class="form-logo" src="/static/logo-blue.png" alt="logo">
      <input class="input" type="text" name="username" placeholder="Username"/>
      <input class="input" type="password" name="password" placeholder="Password"/>
      <input class="button button-primary" type="submit" value="LOGIN"/>

      <span>Non hai ancora un account? <a href="/auth/singup.php">Registrati</a></span>
    </form>
  </div>
</body>
</html>