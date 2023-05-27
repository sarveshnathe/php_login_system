<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="mycontainer">
        <h3>
            <?php 
                output_Username();
            ?>
        </h3>

        <?php
            if(!isset($_SESSION["user_id"])){ ?>            
            <div class="form-container">
                <h3>Login</h3>
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <button class="btn-login">Login</button>    
                </form>
            </div>
        <?php }
        ?>

        <?php
            check_login_errors();
        ?>
    </div>
    
    <div class="mycontainer">
        <h3>Signup</h3>
        <form action="includes/signup.inc.php" method="post">
            <?php 
                signUpInputs();
            ?>
            <button class="btn-signup">SignUp</button>
        </form>

        <?php 
            check_signup_error();
        ?>
    </div>

    <div class="mycontainer">
        <h3>Logout</h3>
        <form action="includes/logout.inc.php" method="post">
            <button class="btn-logout">Logout</button>    
        </form>
    </div>
</body>
</html>
