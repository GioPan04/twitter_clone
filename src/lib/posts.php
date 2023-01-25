<?php

function get_posts(mysqli $db) {
  return $db->query("SELECT * FROM posts INNER JOIN users ON posts.author_id = users.id ORDER BY posts.id DESC");
}