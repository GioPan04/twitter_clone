<?php
include_once "db.php";

function get_posts() {
  global $db;
  return $db->query("SELECT * FROM posts INNER JOIN users ON posts.author_id = users.id ORDER BY posts.id DESC");
}

function get_user_posts($user_id) {
  global $db;
  return $db->query("SELECT * FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.author_id = $user_id ORDER BY posts.id DESC");
}