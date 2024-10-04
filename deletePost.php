<?php
session_start();
require_once 'classes/Post.php';
require_once 'jsonToWord.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "You must be an admin to delete a post.";
    exit();
}

$postObj = new Post();
$postId = $_GET['id'];

$post = $postObj->getPostById($postId);

$postsFile = 'posts.json';

if (!$post || $_SESSION['username'] != $post['author']) {
    echo "You can only delete your own posts.";
    exit();
}

if ($postObj->deletePost($postId, $_SESSION['username'])) {
    echo "<script>
        alert('Post deleted successfully!');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Error deleting post.');
        window.location.href = 'index.php';
        </script>";
}

?>
