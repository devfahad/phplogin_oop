<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOP Login System</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <a class="logo" href="index.php">Logo</a>
            <ul>
                <li><a class="nav-menu" href="index.php">Home</a></li>
                <?php 
                
                if ( isset( $_SESSION['useruid'] ) ) {
                    // Show when logged in
                    echo '<li><a class="nav-menu" href="profile.php">' . $_SESSION['useruid'] . '</a></li>';
                    echo '<li><a class="nav-menu" href="includes/logout.inc.php">Log Out</a></li>';
                } else {
                    // Show when logged out
                    echo '<li><a class="nav-menu" href="signup.php">Sign up</a></li>';
                    echo '<li><a class="nav-menu" href="login.php">Log in</a></li>';
                }
                ?>
                    
            </ul>
        </div>
    </nav>