<?php include_once 'includes/templates/header.php';?>

    <section class="signup-form">
        <h2>Log In</h2>
        <form action="includes/login.inc.php" method="POST">
            <input type="text" name="uid" placeholder="Username/Email Address">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Log In</button>
        </form>

        <p class="member-reg">Not a member? <a href="signup.php">Sign up</a></p>

        <?php
        if ( isset( $_GET['error'] ) ) {
            if ( $_GET['error'] == 'emptyinput' ) {
                echo '<p>Fill in all the fields!</p>';
            } else if ( $_GET['error'] == 'usernotfound' ) {
                echo '<p>User not found!</p>';
            } else if ( $_GET['error'] == 'none' ) {
                echo '<p>Signed up successfully! Please log in</p>';
            } 
        }
        ?>

    </section>

<?php include_once 'includes/templates/footer.php';?>