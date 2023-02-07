<?php
include_once "db.php";

function get_posts() {
  global $db;
  return $db->query("SELECT *, posts.id as post_id, (SELECT COUNT(*) FROM likes WHERE post_id = posts.id) AS likes FROM posts INNER JOIN users ON posts.author_id = users.id ORDER BY posts.id DESC");
}

function get_user_posts($user_id, $auth_id) {
  global $db;
  return $db->query("SELECT *, posts.id as post_id,
    (SELECT COUNT(*) FROM likes WHERE post_id = posts.id) AS likes
    ". (!is_null($auth_id) ? ", (SELECT COUNT(*) FROM likes WHERE post_id = posts.id AND user_id=$auth_id) AS liked " : "") ."
    FROM posts 
    INNER JOIN users ON posts.author_id = users.id
    WHERE posts.author_id = $user_id 
    ORDER BY posts.id DESC
  ");
}

function get_followed_posts($user_id) {
  global $db;
  return $db->query("SELECT p.*, p.id as post_id, u2.*, (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS likes, (SELECT COUNT(*) FROM likes WHERE post_id = p.id AND user_id=$user_id) AS liked
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