<?php
include "lib/db.php";
include "lib/follow.php";
include "lib/posts.php";
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
  $follower = $_SESSION['user']['id'];
  $followed = $_POST['user_id'];

  toggle_follow($follower, $followed);

  $user = $db->query("SELECT username FROM users WHERE id = $followed")->fetch_array();
  header('Location: user.php?u='.$user['username']);
  exit();
}

$username = $_GET['u'];
$user = $db->query("SELECT id, username, first_name, last_name, email FROM users WHERE username = '$username'")->fetch_array();

if(!$user) {
  include "404.php";
  exit();
}

$followers = $db->query("SELECT COUNT(*) as count FROM follows WHERE followed_id = " . $user['id'])->fetch_array();

if(isset($_SESSION['user'])) {
  $following = $db->query("SELECT COUNT(*) as following FROM follows WHERE follower_id = {$_SESSION['user']['id']} AND followed_id = {$user['id']}")->fetch_array()['following'];
  $posts = get_user_posts($user['id'], $_SESSION['user']['id']);
} else {
  $posts = get_user_posts($user['id'], null);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/static/style.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <title>Profilo di <?php echo $user['username'] ?></title>
</head>
<body>
  <?php include "components/navbar.php"; ?>
  <div class="content">
    <div class="profile-banner">
      <div class="profile-banner-image" style="background-image: url('https://picsum.photos/1000/200')"></div>
      <div class="profile-banner-content">
        <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email']))) ?>?s=256" alt=""/>
        <div class="profile-banner-info">
          <span class="profile-banner-name"><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></span>
          <span>@<?php echo $user['username'] ?></span>
          <span><?php echo $followers['count'] ?> followers</span>
          <?php if(isset($following)): ?>
            <form action="user.php" method="post">
              <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>"/>
              <input type="submit" value="<?php echo $following ? "UNFOLLOW" : "FOLLOW" ?>"/>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="posts-list">
      <?php 
      
      while($row = $posts->fetch_array()) {
        include "components/post.php";
      }
      ?>
    </div>
  </div>
</body>
</html>