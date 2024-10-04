<?php
    session_start();

    //unset all session variables
    $_SESSION = array();

    // Destroy all session variables
    session_destroy();

    header("Location: signup.php");
    exit();
?>