<article class="post">
  <span>Postato da: <?php echo $row['username'] ?></span>
  <span class="post-content"><?php echo $row['content'] ?></span>
  <span class="grayed"><?php echo date('H:i:s d/m/Y', strtotime($row['posted_at'])) ?></span>
</article>