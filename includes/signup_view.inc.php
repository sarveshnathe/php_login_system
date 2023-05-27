<?php

declare(strict_types=1);

function signUpInputs(){

    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errorsSignUp"]["usernameTaken"])){
        echo '<input type="text" name="username" placeholder="Username" value="'. $_SESSION["signup_data"]["username"] .'">';
    }else{
        echo '<input type="text" name="username" placeholder="Username">';
    }

    echo '<input type="password" name="pwd" placeholder="Password">';

    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errorsSignUp"]["emailUsed"]) && !isset($_SESSION["errorsSignUp"]["invalidEmail"])){
        echo '<input type="text" name="email" placeholder="E-Mail" value="'. $_SESSION["signup_data"]["email"] .'">';
    }else{
        echo '<input type="text" name="email" placeholder="E-Mail">';
    }
}


function check_signup_error(){
    if(isset($_SESSION['errorsSignUp'])){
        $errors=$_SESSION['errorsSignUp'];

        echo "</br>";
        foreach($errors as $error){
            echo '<p>'. $error .'</p>';
        }
        unset($_SESSION['errorsSignUp']);
    }else if(isset($_GET["signup"]) && $_GET["signup"]==="success")
    {
        echo '</br>';
        echo '<p>SignUp Success!!</p>';
    }
}