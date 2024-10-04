<?php
session_start();
require_once 'classes/Post.php';

$postObj = new Post();
$posts = $postObj->getPosts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./style/home.css">
</head>
<body>
    <div>
    <?php include('./nav.php') ?>
<section>
<div class="container">
    <p class="heading">All Posts</p>
    
    <div class="posts">
        <?php
        if ($posts) {
            foreach ($posts as $post) {
                echo '<div class="post-card">';
                echo "<h3>".$post['title']."</h3>";
                echo "<p>".$post['content']."</p>";
                echo "<br><small> Posted by ".$post['author']." on ".$post['date'] . "</small>";
                echo '<a href="viewPost.php?id='.$post['id'].'" class="read-more-btn">Read More</a>';
                echo "</div>";
            }
        } else {
            echo "No post available!";
        }
        ?>
    </div>
</div>
</section>

</body>
</html>


