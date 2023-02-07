<?php

session_start();
if(!isset($_SESSION['user'])) {
    header("Location: {$_POST['back']}");
    die(401);
}

include_once "lib/db.php";

$user_id = $_SESSION['user']['id'];
$post_id = $_POST['id'];

$liked = $db->query("SELECT 1 FROM likes WHERE user_id = $user_id AND post_id = $post_id")->fetch_assoc();

var_dump($liked);

if($liked) {
    $db->query("DELETE FROM likes WHERE user_id = $user_id AND post_id = $post_id");
} else {
    $db->query("INSERT INTO likes (user_id,post_id) VALUES($user_id, $post_id)");
}

header("Location: {$_POST['back']}");
?>