<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM posts WHERE id = $id";
$conn->query($sql);
header("Location: index.php");
?>