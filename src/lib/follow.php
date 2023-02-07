<?php
include_once "db.php";

function toggle_follow($follower, $followed) {
  if(is_following($follower, $followed)) {
    unfollow($follower, $followed);
  } else {
    follow($follower, $followed);
  }
}

function is_following($follower, $followed) {
  global $db;
  return $db->query("SELECT COUNT(*) as following FROM follows WHERE follower_id = $follower AND followed_id = $followed")->fetch_array()['following'];
}

function follow($follower, $followed) {
  global $db;
  $db->query("INSERT INTO follows (follower_id, followed_id) VALUES ($follower, $followed)");
}

function unfollow($follower, $followed) {
  global $db;
  $db->query("DELETE FROM follows WHERE follower_id = $follower AND followed_id = $followed");
}

function get_friends($user_id) {
  global $db;
  return $db->query("SELECT DISTINCT u.first_name, u.last_name, u.username, u.email
    FROM follows a
    INNER JOIN follows b ON a.followed_id = b.follower_id
    INNER JOIN users u ON u.id = b.followed_id
    WHERE a.follower_id = $user_id AND a.follower_id <> b.followed_id");
}