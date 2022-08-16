<?php

// If you want to change something inside the db, we do it here

class LoginController extends Login {

    private $uid;
    private $pwd;

    public function __construct( $uid, $pwd ) {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function loginUser() {
        if ( $this->emptyInput() ) {
            // echo 'Empty input!';
            header( 'location: ../login.php?error=emptyinput' );
            exit();
        }

        // getUser from the DB
        $this->getUser( $this->uid, $this->pwd );
    }

    // Error Handler method
    private function emptyInput() {
        $result = false;

        if ( empty( $this->uid ) || empty( $this->pwd ) ) {
            $result = true;
        }
        return $result;
    }

}