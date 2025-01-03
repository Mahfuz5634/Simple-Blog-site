<?php
include 'db.php';

$sql = "SELECT posts.*, 
               (SELECT COUNT(*) FROM comments WHERE post_id = posts.id) AS comment_count,
               (SELECT COUNT(*) FROM likes WHERE post_id = posts.id) AS like_count
        FROM posts 
        ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Blog Home</title>
</head>
<body>
    <div class="container">
        <h1>Blog Posts</h1>
        <a href="create_post.php"><button>Create New Post</button></a>
        <div class="posts">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <h2><a href="view_post.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a></h2>
                    <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Post Image"> <!-- Add image here -->
                    <p><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                    <p><strong>Likes: <?= $row['like_count'] ?></strong> | <strong>Comments: <?= $row['comment_count'] ?></strong></p>
                    
                    <!-- Like and Comment Buttons -->
                    <div class="post-actions">
                        <form method="POST" action="like_post.php" style="display:inline;">
                            <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                            <button type="submit">Like</button>
                        </form>
                        <form method="POST" action="view_post.php?id=<?= $row['id'] ?>" style="display:inline;">
                            <button type="submit">Comment</button>
                        </form>
                    </div>

                    <!-- Edit and Delete Buttons (hidden in index.php) -->
                    <div class="edit-delete-actions" style="display:none;">
                        <a href="edit_post.php?id=<?= $row['id'] ?>"><button>Edit</button></a>
                        <a href="delete_post.php?id=<?= $row['id'] ?>"><button>Delete</button></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <footer>
        <p>Project made by Mahfuz, Alif, Luvna</p>
    </footer>
</body>
</html>