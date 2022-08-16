<?php
// This is where we interact with the DB

// Signup class
class Signup extends Dbh {

    // setUser to the DB
    protected function setUser( $uid, $pwd, $email ) {
        // Prepared statement to insert a new row in users table
        $stmt = $this->connect()->prepare( 'INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);' );
        
        // Password hashing
        $hashedPwd = password_hash( $pwd, PASSWORD_DEFAULT );

        // Execute and check the prepared stmt
        if( !$stmt->execute( array( $uid, $hashedPwd, $email ) ) ) {
            $stmt = null;
            header( 'location: ../signup.php?error=stmtfailed' );
            exit();
        }

        $stmt = null;
    }

    // checkUser from the DB
    protected function checkUser( $uid, $email ) {
        // Prepared statement to select one column named users_id
        $stmt = $this->connect()->prepare( 'SELECT users_id FROM users WHERE users_uid = ? OR users_email = ?;' );

        // Execute and check the prepared stmt
        if ( !$stmt->execute( array( $uid, $email ) ) ) {
            $stmt = null;
            header( 'location: ../signup.php?error=stmtfailed' );
            exit();
        }

        // Check if there is any row/result from the query
        $resultCheck = false;
        if ( !$stmt->rowCount() > 0 ) {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}