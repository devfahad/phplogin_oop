<?php

if( isset( $_POST['submit'] ) ) {

    // Grabbing the data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    

    // Instantiate SignupController class
    include_once '../classes/dbh.classes.php';
    include_once '../classes/login.classes.php';
    include_once '../classes/login-controller.classes.php';
    $login = new LoginController( $uid, $pwd, $pwdRepeat, $email );

    // Running error handlers and user signup
    $login->loginUser();

    // Going back to the front page
    header( 'location: ../profile.php?error=none' );
}