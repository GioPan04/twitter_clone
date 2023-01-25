<?php
include_once "db.php";

function login($username, $password) {
  global $db;
  $user = $db->query("SELECT * FROM users WHERE username = '$username' LIMIT 1")->fetch_array();
  if(empty($user) || !password_verify($password, $user['password'])) return false;

  return $user;
}

function singup($username, $password, $first_name, $last_name, $email) {
  $password = password_hash($password, PASSWORD_BCRYPT);

  global $db;
  $db->query("INSERT INTO users (username, password, first_name, last_name, email) VALUES ('$username', '$password', '$first_name', '$last_name', '$email')");

  $user = $db->query("SELECT * FROM users WHERE username = '$username' LIMIT 1")->fetch_array();
  return $user;
}