<?php

function login(mysqli $db, $username, $password) {
  $user = $db->query("SELECT * FROM users WHERE username = '$username' LIMIT 1")->fetch_array();
  if(empty($user) || !password_verify($password, $user['password'])) return false;

  return $user;
}