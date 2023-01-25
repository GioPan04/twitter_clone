<?php
include "lib/db.php";
include "lib/posts.php";
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="static/style.css"/>
  <title>Twitter clone</title>
</head>
<body>
  <?php include "components/navbar.php" ?>
  <div class="content">

    <?php
      $posts = get_posts($db);
      while($row = $posts->fetch_assoc()) {
        include "components/post.php";
      }
    ?>
  </div>
</body>
</html>