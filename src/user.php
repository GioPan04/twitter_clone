<?php
include "lib/db.php";

$username = $_GET['u'];
$user = $db->query("SELECT id, username, first_name, last_name, email FROM users WHERE username = '$username'")->fetch_array();

if(!$user) {
  include "404.php";
  exit();
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/static/style.css"/>
  <title>Profilo di <?php echo $user['username'] ?></title>
</head>
<body>
  <?php include "components/navbar.php"; ?>
  <div class="content">

    <div style="background-image: url('https://picsum.photos/1000/200');" class="profile-banner">
      <div></div>
      <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email']))) ?>?s=256" alt=""/>
      <span class="profile-banner-name"><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></span>
    </div>

    <div class="posts-list">
      <?php 
      include "lib/posts.php";
      $posts = get_user_posts($user['id']);
      
      while($row = $posts->fetch_array()) {
        include "components/post.php";
      }
      ?>
    </div>
  </div>
</body>
</html>