<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./style/viewPost.css">
</head>
<body>
    
    <?php 
        session_start();
        require_once 'classes/Post.php';
        include('nav.php');
        
        echo "<div class='container'>";

        // checking if post id is set in the url
        if(isset($_GET['id'])){
            $postId = $_GET['id']; // storing the id
            
            $postObj = new Post();
            $post = $postObj->getPostById($postId);
            
            if($post){
                echo "<h1 class='title'>".$post['title']."</h1>";
                echo "<p class='info' style='padding: 10px 0'>Posted by ".$post['author']. " on ". $post['date']. "</p>";
                echo "<p class='content'>".$post['content']."</p>";
            }else{
                echo "<h2 class='title'>No Post found</h2>";
            }
        }
        echo "</div>";    
        ?>
</body>
</html>