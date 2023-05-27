<?php

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $username=$_POST["username"];
    $password=$_POST["pwd"];
    $email=$_POST["email"];

    try{
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        //ERROR HANDLERS
        $errors=[];
        if(isInputEmpty($username, $password, $email)){
            $errors["emptyInput"]="Fill in all Fields";
        }
        if(isEmailInvalid($email)){
            $errors["invalidEmail"]="Invalid email used!";
        }
        if(isUsernameTaken($pdo, $username)){
            $errors["usernameTaken"]="Username already exists!";
        }
        if(isEmailRegistered($pdo, $email)){
            $errors["emailUsed"]="Email is already registred!";
        }

        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errorsSignUp"]=$errors;
            
            $signupData=[
                "username"=>$username,
                "email"=>$email
            ];
            $_SESSION["signup_data"]=$signupData;
            
            header("Location: ../index.php");
            die();
        }

        createUser($pdo, $username, $password, $email);

        header("Location: ../index.php?signup=success");
        $pdo=null;
        $stmt=null;
        die();
        
    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../index.php");
    die();
}