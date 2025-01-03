<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT posts.*, 
               (SELECT COUNT(*) FROM comments WHERE post_id = posts.id) AS comment_count,
               (SELECT COUNT(*) FROM likes WHERE post_id = posts.id) AS like_count
        FROM posts WHERE id = $id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $content = $_POST['comment'];
    $sql = "INSERT INTO comments (post_id, content) VALUES ($id, '$content')";
    $conn->query($sql);
    header("Location: view_post.php?id=$id");
}

if (isset($_POST['like'])) {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT IGNORE INTO likes (post_id, user_ip) VALUES ($id, '$user_ip')";
    $conn->query($sql);
}

$comments_sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at DESC";
$comments_result = $conn->query($comments_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="Post Image" style="max-width: 100%; border-radius: 8px; margin-bottom: 10px;"> <!-- Display post image -->
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <p><strong>Likes: <?= $post['like_count'] ?></strong> | <strong>Comments: <?= $post['comment_count'] ?></strong></p>

        <!-- Like Button -->
        <form method="POST" action="like_post.php" style="display:inline;">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <button type="submit">Like</button>
        </form>

        <!-- Comment Submission -->
        <form method="POST" action="">
            <textarea name="comment" placeholder="Add a comment..." required></textarea>
            <button type="submit">Comment</button>
        </form>

        <!-- Edit and Delete Buttons -->
        <div class="post-actions">
            <a href="edit_post.php?id=<?= $post['id'] ?>"><button>Edit</button></a>
            <a href="delete_post.php?id=<?= $post['id'] ?>"><button>Delete</button></a>
        </div>

        <h2>Comments</h2>
        <div class="comments">
            <?php while($comment = $comments_result->fetch_assoc()): ?>
                <div class="comment">
                    <p><?= htmlspecialchars($comment['content']) ?></p>
                    <small>Posted on <?= $comment['created_at'] ?></small>
                </div>
            <?php endwhile; ?>
        </div>

        <p><a href="index.php">Back to Home</a></p>
    </div>
    <footer>
        <p>Project made by Mahfuz, Alif, Luvna</p>
    </footer>
</body>
</html>