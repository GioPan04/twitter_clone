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

function get_followed_posts($user_id) {
  global $db;
  return $db->query("SELECT p.*, u2.*
    FROM 
    users AS u 
    INNER JOIN follows AS f ON f.follower_id = u.id 
    INNER JOIN users as u2 ON u2.id = f.followed_id 
    INNER JOIN posts AS p ON p.author_id = u2.id 
    WHERE 
    u.id = $user_id 
    ORDER BY p.posted_at DESC 
    LIMIT 10 "
  );
}