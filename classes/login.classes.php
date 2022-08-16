<?php
// This is where we interact with the DB

// Login class
class Login extends Dbh {

    // getUser from the DB
    protected function getUser( $uid, $pwd ) {
        // Prepared statement to get users_pwd from DB using email/username
        $stmt = $this->connect()->prepare( 'SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;' );

        // Execute and check the prepared stmt
        if ( !$stmt->execute( array( $uid, $pwd ) ) ) {
            $stmt = null;
            header( 'location: ../login.php?error=stmtfailed' );
            exit();
        }

        // Check if there is no row/result from the query
        if ( $stmt->rowCount() == 0 ) {
            $stmt = null;
            header( 'location: ../login.php?error=usernotfound' );
            exit();
        }

        // Check pwd
        $pwdHashed = $stmt->fetchAll( PDO::FETCH_ASSOC );
        $checkPwd  = password_verify( $pwd, $pwdHashed[0]['users_pwd'] );

        if ( $checkPwd == false ) {
            $stmt = null;
            header( 'location: ../login.php?error=wrongpassword' );
            exit();
        } else {
            $stmt = $this->connect()->prepare( 'SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;' );

            if ( !$stmt->execute( array( $uid, $uid, $pwd ) ) ) {
                $stmt = null;
                header( 'location: ../login.php?error=stmtfailed' );
                exit();
            }

            if ( $stmt->rowCount() == 0 ) {
                $stmt = null;
                header( 'location: ../login.php?error=usernotfound' );
                exit();
            }

            $user = $stmt->fetchAll( PDO::FETCH_ASSOC );

            // Session start
            session_start();
            $_SESSION['userid'] = $user[0]['users_id'];
            $_SESSION['useruid'] = $user[0]['users_uid'];

            $stmt = null;
        }

        $stmt = null;

    }

}