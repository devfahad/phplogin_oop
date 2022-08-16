<?php

if( isset( $_POST['submit'] ) ) {

    // Grabbing the data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];
    

    // Instantiate SignupController class
    include_once '../classes/dbh.classes.php';
    include_once '../classes/signup.classes.php';
    include_once '../classes/signup-controller.classes.php';
    $signup = new SignupController( $uid, $pwd, $pwdRepeat, $email );

    // Running error handlers and user signup
    $signup->signupUser();

    // Going back to the front page
    header( 'location: ../login.php?error=none' );
}