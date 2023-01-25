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
</head>
<body>
  <form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username"/>
    <input type="text" name="password" placeholder="Password"/>
    <input type="submit" value="LOGIN"/>
  </form>
</body>
</html>