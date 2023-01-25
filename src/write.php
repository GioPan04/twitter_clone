<?php
session_start();
if(!isset($_SESSION['user'])) {
  header('Location: /auth/login.php');
  exit(401);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  include "lib/db.php";
  
  $content = $_POST['content'];
  $author = $_SESSION['user']['id'];
  $db->query("INSERT INTO posts (author_id, content, posted_at) VALUES ($author, '$content', NOW())");

  header('Location: /');
  exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/static/style.css"/>
  <title>Scrivi nuovo post - Twitter clone</title>
</head>
<body>
  <?php include "components/navbar.php"; ?>
  
  <div class="content">
    <form action="write.php" method="POST">
      <textarea name="content" cols="30" rows="10" placeholder="What are you thinking about?"></textarea>
      <input type="submit" value="POST"/>
    </form>
  </div>
</body>
</html>