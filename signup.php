<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./style/sign.css">
</head>
<body>
    <div class="container">
        <div class="form_wrap">
            <form action="signup.php" method="post">
            <div class="form_group">
                <h1>Sign Up</h1>
                <p>It's free and only takes a minute</p>
            </div>
            <div class="form_group">
            <label for="username">Username</label><br>
                <input type="text" id="username" name="username" required><br>
            </div>
            
            <div class="form_group">
            <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required><br>
            </div>
            
            <div class="form_group">
            <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br><br>
            </div>
            
            <div class="form_group">
                <button type="submit" id="signUp">Sign Up</button>
            </div>
            <div class="form_group bottom_text">
                    <p>By clicking the Sign Up button, you agree to our <a href="#">Terms & conditions</a> and <a
                            href="#">Privacy
                            Policy</a></p>
                </div>
            </form>
        </div>
        <p>Already have an account?<a href="login.php" class="logIn">Login Here</p>
        <footer>
            <a href="home.php" style="color: white;">Skip for now</p>
        </footer>

    </div>
    </body>
    </html>
        
            
                
                

<?php 
    //sign-up logic
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Load users data from JSON file
        $jsonData = file_get_contents('users.json');
        $users = json_decode($jsonData, true);

        foreach($users as $user){
            if($user['username'] == $username){
                echo "Username already exists!";
                exit();
            }else if($user['email'] == $email){
                echo "email already exists!";
                exit();
            }
        }

        // Hash the password for security
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser = array(
            'username' =>$username,
            'email' => $email,
            'password' => $hashPassword,
            'role' => 'user' // default role for a user
        );

        // Add user to the users array
        $users[] = $newUser;


        // Save updated users data back to JSON file
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

        echo "Registration successful! <a href='login.php'>Login here</a>";
        header("location: home.php");

        // Log new user creation to word document
        $content = "New User Signed up:\nUsername: $username\nEmail: $email\n";
        saveToWordDocument($content);
    }
?> 

