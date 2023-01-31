<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  include "../lib/db.php";
  include "../lib/auth.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $user = singup($username, $password, $first_name, $last_name, $email);
  
  session_start();
  $_SESSION['user'] = $user;
  header('Location: /');
  exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrazione - Twitter</title>
</head>
<body>
  <form action="singup.php" method="POST">
    <input type="text" name="username" placeholder="Username"/>
    <input type="text" name="password" placeholder="Password"/>
    <input type="text" name="first_name" placeholder="Nome"/>
    <input type="text" name="last_name" placeholder="Cognome"/>
    <input type="text" name="email" placeholder="Email"/>

    <input type="submit" value="REGISTRATI"/>
  </form>
</body>
</html>