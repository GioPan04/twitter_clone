<article class="post">
  
  <div class="post-author">
    <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($row['email']))) ?>?s=40" alt=""/>
    <a href="/user.php?u=<?php echo $row['username'] ?>" class="post-author-username">@<?php echo $row['username'] ?></a>
  </div>
  <span class="post-content"><?php $row['content'] ?></span>
  
  <div class="post-bottom">
    <div class="post-actions">
      <form action="/post-action.php" method="post">
        <input type="hidden" name="action" value="like">
        <input type="hidden" name="back" value="<?php echo $_SERVER['REQUEST_URI']?>">
        <input type="hidden" name="id" value="<?php echo $row['post_id']?>">
        <button type="submit">
          <span class="material-symbols-outlined <?php echo isset($row['liked']) && $row['liked'] ? 'icon-liked' : '' ?>">favorite</span>
        </button>
      </form>
      <span class="grayed"><?php echo $row['likes'] ?></span>
    </div>
    <span class="grayed"><?php echo date('H:i:s d/m/Y', strtotime($row['posted_at'])) ?></span>
  </div>
</article>