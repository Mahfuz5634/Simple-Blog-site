<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT IGNORE INTO likes (post_id, user_ip) VALUES ($post_id, '$user_ip')";
    $conn->query($sql);
}

header("Location: index.php");
?>