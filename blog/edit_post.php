<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = $id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $id";
    $conn->query($sql);
    header("Location: view_post.php?id=$id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Post</title>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <form method="POST">
            <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
            <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea>
            <button type="submit">Update Post</button>
        </form>
        <p><a href="view_post.php?id=<?= $post['id'] ?>">Back to Post</a></p>
    </div>
    <footer>
        <p>Project made by Mahfuz, Alif, Luvna</p>
    </footer>
</body>
</html>