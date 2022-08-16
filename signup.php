<?php include_once 'includes/templates/header.php';?>

    <section class="signup-form">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="name" placeholder="Full name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Repeat password">
            <button type="submit" name="submit">Sign Up</button>
        </form>

        <p class="member-reg">Already have an account? <a href="login.php">Login</a></p>

        <?php
        if ( isset( $_GET['error'] ) ) {
            if ( $_GET['error'] == 'emptyinput' ) {
                echo '<p>Fill in all the fields!</p>';
            } else if ( $_GET['error'] == 'invalidusername' ) {
                echo '<p>Choose a proper username!</p>';
            } else if ( $_GET['error'] == 'invalidemail' ) {
                echo '<p>Choose a proper email!</p>';
            } else if ( $_GET['error'] == 'pwddontmatch' ) {
                echo '<p>Passwords didn\'t match! Please try again</p>';
            } else if ( $_GET['error'] == 'stmtfailed' ) {
                echo '<p>Something went wrong, please try again!</p>';
            } else if ( $_GET['error'] == 'useroremailtaken' ) {
                echo '<p>Username already taken!</p>';
            } 
        }
        ?>

    </section>



<?php include_once 'includes/templates/footer.php';?>