<article class="post">
  
  <div class="post-author">
    <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($row['email']))) ?>?s=40" alt=""/>
    <a href="/user.php?u=<?php echo $row['username'] ?>" class="post-author-username">@<?php echo $row['username'] ?></a>
  </div>
  <span class="post-content"><?php echo $row['content'] ?></span>
  <span class="grayed"><?php echo date('H:i:s d/m/Y', strtotime($row['posted_at'])) ?></span>
</article>