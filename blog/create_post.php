<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url']; // Get the image URL

    $sql = "INSERT INTO posts (title, content, image_url) VALUES ('$title', '$content', '$image_url')";
    $conn->query($sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Create Post</title>
</head>
<body>
    <div class="container">
        <h1>Create New Post</h1>
        <form method="POST">
            <input type="text" name="title" placeholder="Post Title" required>
            <textarea name="content" placeholder="Post Content" required></textarea>
            <input type="text" name="image_url" placeholder="Image URL" required> <!-- Input for image URL -->
            <button type="submit">Create Post</button>
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
    <footer>
        <p>Project made by Mahfuz, Alif, Luvna</p>
    </footer>
</body>
</html>