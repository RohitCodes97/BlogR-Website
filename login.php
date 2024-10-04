<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/sign.css">
</head>

<body>

    <div class="container">
        <div class="form_wrap">
            <form action="login.php" method="post">
                <div class="form_group">
                    <h2>Login</h2>
                    <label for="username">Username: </label><br>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form_group">
                    <label for="password" >Password:</label><br>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form_group"><button type="submit">Login</button></div>
            </form>
        </div>
    </div>

</body>
</html>

<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Load users data from JSON file
    $jsonData = file_get_contents('users.json');
    $users = json_decode($jsonData, true);

    //Find the user by username
    foreach($users as $user){
        if($user['username'] == $username){
            //verify the password
            if(password_verify($password, $user['password'])){
                $_SESSION['username'] = $user['username'];
                //! new changes so the role changes to admin
                $_SESSION['role'] = 'admin';
                echo "Login successful! Welcome, ".$_SESSION['username'];

                //Redirect to createPost page after login
                header("Location: home.php");
                exit();
            }else{
                echo "Invalid Password!";
                exit();
            }
        }
    }
    echo "User not found!";
}
?>