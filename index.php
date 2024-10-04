<?php
session_start();
require_once 'classes/Post.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$postObj = new Post();
$posts = $postObj->getPosts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="./style/yourPost.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

    <?php include('./nav.php') ?>

    <h2>Your Posts</h2>
    <div class="container">
    <?php
    if ($posts){

        if(isset($_SESSION['username'])){
            $currentUsername = $_SESSION['username'];

            $userHasPosts = false;

        foreach ($posts as $post) {
            if($post['author']== $currentUsername){

            $userHasPosts = true;
            echo '<div class="post-item">';
            echo "<h3>" . $post['title'] . "</h3>";
            echo "<p>" . $post['content']. "</p>";
            echo "<small>Posted by " .$post['author']. " on " . $post['date'] . "</small>"."<br>";

                echo "<a href='updatePost.php?id=" . $post['id'] . "' class='btn edit-btn'>Update</a>";
                echo "<a href='deletePost.php?id=" . $post['id'] . "' class='btn delete-btn'>Delete</a>";
                echo "</div>";
            }
        }
    }
} else {
        echo "<p>No posts available.</p>";
    }
    ?>
    </div>
    
</body>
</html>
