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