<?php
include "lib/db.php";
include "lib/posts.php";
include "lib/follow.php";
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="static/style.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <title>Twitter clone</title>
</head>
<body>
  <?php include "components/navbar.php" ?>
  <div class="content">
    <?php if(isset($_SESSION['user'])) : ?>
      <div>
        <h3 class="subtitle">Potresti conoscere</h3>
        <div class="friends-list">
          <?php
            $friends = get_friends($_SESSION['user']['id']);
            while($user = $friends->fetch_assoc()) include "components/friend.php";
          ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="posts-list">
      <?php
      $posts = isset($_SESSION['user']) ? get_followed_posts($_SESSION['user']['id']) : get_posts();
      while($row = $posts->fetch_assoc()) {
        include "components/post.php";
      }
      ?>
    </div>
  </div>
</body>
</html>