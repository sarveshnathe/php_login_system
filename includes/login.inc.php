<?php


if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST["username"];
    $password=$_POST["pwd"];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

         //ERROR HANDLERS
        $errors=[];
        if(isInputEmpty($username, $password)){
            $errors["emptyInput"]="Fill in all Fields";
        }
        $result=getUser($pdo, $username);

        if(isUsernameWrong($result)){
            $errors["login_incorrect"]="Incorrect Login Info!";
        }
        if(!isUsernameWrong($result) && isPasswordWrong($password, $result["pwd"])){
            $errors["login_incorrect"]="Incorrect Login Info!";
        }
 
        require_once 'config_session.inc.php';
 
        if($errors){
            $_SESSION["errors_login"]=$errors;
             
            header("Location: ../index.php");
            die();
        }

        $newSessionId=session_create_id();
        $sessionId=$newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"]=$result["id"];
        $_SESSION["user_username"]=htmlspecialchars($result["username"]);

        $_SESSION['last_regeneration']=time();

        header("Location: ../index.php?login=success");
        $pdo=null;
        $stmt=null;
       
        die();


    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
    die();
}