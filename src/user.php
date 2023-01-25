<?php
include "lib/db.php";

$username = $_GET['u'];
$user = $db->query("SELECT id, username, first_name, last_name FROM users WHERE username = '$username'")->fetch_array();

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
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/static/style.css"/>
  <title>Profilo di <?php echo $user['username'] ?></title>
</head>
<body>
  <?php include "components/navbar.php"; ?>
  <div class="content">
    <h3>Post di <?php echo $user['username'] ?></h3>

    <?php 
      include "lib/posts.php";
      $posts = get_user_posts($user['id']);
      
      while($row = $posts->fetch_array()) {
        include "components/post.php";
      }
    ?>
  </div>
</body>
</html>