<nav class="navbar">
  <a href="/">Twitter</a>

  <?php if(isset($_SESSION['user'])) : ?>
    <div>
      <span>Accesso effettuato come <?php echo $_SESSION['user']['username'] ?></span>
      <a href="/write.php">Nuovo post</a>
      <a href="/auth/logout.php">Logout</a>
    </div>
  <?php else : ?>
    <a href="/auth/login.php">Login</a>
  <?php endif; ?>
</nav>