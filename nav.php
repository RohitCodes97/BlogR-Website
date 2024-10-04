<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
</head>
<body>
<header class="header">
        <nav class="nav" >
            <a href="home.php" class="logo">BlogR</a>
            <ul class="nav_links">
                <li class="nav_item"><a class="nav_link" href="home.php">Home</a></li>
                <li class="nav_item">
                    <a class="nav_link" href="createPost.php">Add Post</a></li>
                <li class="nav_item">
                    <a class="nav_link" href="index.php">Your Blogs</a></li>
                    <div class="dropdown">
                <button class="dropbtn"><?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'); ?><i class="fa fa-caret-down"></i>
                </button>
               
    <div class="dropdown-content">
    <?php 
        if(isset($_SESSION['username'])){
            echo "<a href='logout.php' style='color: red'>Logout</a>";
        }else{
            echo "<a href='signup.php' style='color: white'>Sign up / Sign in</a>";
        }
    ?>
   
    </div>
    </div>
</ul>
</nav>
</header>
</body>
</html>