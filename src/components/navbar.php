<nav class="navbar">
  <a href="/"><img class="navbar-logo" src="/static/logo-white.png" alt="logo"></a>

  <?php if(isset($_SESSION['user'])) : ?>
    <div class="navbar-actions">
      <a href="/user.php?u=<?php echo $_SESSION['user']['username'] ?>">
        <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['user']['email']))) ?>?s=32" alt="">
      </a>
      <a href="/write.php">Nuovo post</a>
      <a href="/auth/logout.php">Logout</a>
    </div>
  <?php else : ?>
    <a href="/auth/login.php">Login</a>
  <?php endif; ?>
</nav>