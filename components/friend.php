<a href="/user.php?u=<?php echo $user['username'] ?>" class="friend">
    <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email']))) ?>?s50" alt="">
    <div>
        <span><?php echo $user['first_name'] ?></span>
        <span><?php echo $user['last_name'] ?></span>
    </div>
    <span>@<?php echo $user['username'] ?></span>
</a>