<?php
session_start();
require_once 'classes/Post.php';
require_once 'jsonToWord.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>
            alert('You must be an admin to create a post!');
            window.location.href = 'home.php';
            </script>";
    exit();
}

$post = new Post();

$postsFile = 'posts.json';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username']; // Logged-in admin who creates the post

    $post->createPost($title, $content, $author);
    // echo "Post created successfully!";
    echo "<script>
            alert('Post created successfully!');
            window.location.href = 'home.php';
            </script>";
    
    //* New post creation to word document
    $postContent = "New Post created:\nTitle: $title\nContent: $content\nAuthor: $author\n";
    
    saveToWordDocument($postContent);
    
    //* export updated posts.json to the word document
    exportJsonToWord($postsFile);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./style/createPost.css">
</head>
<body>
<?php include('./nav.php') ?>

    <div class="container">
        <div class="form_wrap">
            <form method="POST" action="createPost.php">
                <div class="form_group">
                    <h2>Add New Post</h2>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br>
                </div>
                <div class="form_group">
                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" rows="5" required></textarea><br>
                </div>
                <div class="form_group"><button type="submit">Create Post</button></div>
            </form>
        </div>
    </div>
</body>

</html>
