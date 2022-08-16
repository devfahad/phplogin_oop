<?php

// If you want to change something inside the db, we do it here

class SignupController extends Signup {

    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct( $uid, $pwd, $pwdRepeat, $email ) {
        $this->uid       = $uid;
        $this->pwd       = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email     = $email;
    }

    public function signupUser() {
        // Check errors
        if ( $this->emptyInput() ) {
            // echo 'Empty input!';
            header( 'location: ../signup.php?error=emptyinput' );
            exit();
        }
        if ( $this->invalidUid() ) {
            // echo 'Invalid username!';
            header( 'location: ../signup.php?error=invalidusername' );
            exit();
        }
        if ( $this->invalidEmail() ) {
            // echo 'Invalid email!';
            header( 'location: ../signup.php?error=invalidemail' );
            exit();
        }
        if ( $this->pwdMatch() ) {
            // echo 'Passwords don't match!';
            header( 'location: ../signup.php?error=pwddontmatch' );
            exit();
        }
        if ( $this->uidTakenCheck() ) {
            // echo 'Username or email taken';
            header( 'location: ../signup.php?error=useroremailtaken' );
            exit();
        }

        // setUser to the DB
        $this->setUser( $this->uid, $this->pwd, $this->email );
    }

    // Error Handler methods
    private function emptyInput() {
        $result = false;

        if ( empty( $this->uid ) || empty( $this->pwd ) || empty( $this->pwdRepeat ) || empty( $this->email ) ) {
            $result = true;
        }
        return $result;
    }

    private function invalidUid() {
        $result = false;

        if ( !preg_match( '/^[a-zA-Z0-9]*$/', $this->uid ) ) {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail() {
        $result = false;

        if ( !filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch() {
        $result = false;
        if ( $this->pwd !== $this->pwdRepeat ) {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck() {
        $result = false;
        if ( !$this->checkUser( $this->uid, $this->email ) ) {
            $result = true;
        }
        return $result;
    }

}