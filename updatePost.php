<?php
session_start();
require_once 'classes/Post.php';
require_once 'jsonToWord.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "You must be an admin to update a post.";
    exit();
}

$postObj = new Post();
$postId = $_GET['id'];
$post = $postObj->getPostById($postId);


if (!$post || $_SESSION['username'] != $post['author']) {
    echo "You can only update your own posts.";
    exit();
}

$postsFile = 'posts.json';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];

    $updatedPost = $postObj->updatePost($postId, $title, $content, $author);
    if ($updatedPost) {
        echo "Post updated successfully!";
        echo "<script>
            alert('Post updated successfully!');
            window.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
            alert('Error updating post!');
            window.location.href = 'index.php';
            </script>";
    }

    //* Logging post update to word document
    $updateContent = "Post Updated:\nTitle: $title\nContent: $content\nAuthor: $author\n";
    
    saveToWordDocument($updateContent);
    
    //* export updated posts.json to the word document
    exportJsonToWord($postsFile);
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./style/createPost.css">
</head>
<body>
    <?php include('nav.php') ?>
    <div class="container">
        <div class="form_wrap">
            <form method="POST" action="updatePost.php?id=<?php echo $postId; ?>">
                <div class="form_group">
                    <h2>Update Post</h2>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required><br>
                </div>
                <div class="form_group">
                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" rows="5" cols="40" required><?php echo $post['content']; ?></textarea><br>
                </div>
                <div class="form_group"><button type="submit">Update Post</button></div>
            </form>
        </div>
    </div>

    
</body>
</html>
