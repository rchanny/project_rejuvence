<?php
require_once "include/common.php";

if(trim($_POST['email']) != '' && trim($_POST['password']) && trim($_POST['confirm_password']) && count($_POST['categories'])!=0){

    // Retrieve form input values
    $email = $_POST['email'];

    $categories = $_POST['categories'];
    $categories_string = implode(",",$categories);
    
    $fullname = $_POST['fullname'];
 
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // If passwords do not match:
    if($password != $confirm_password) {
         // 1) Register Error message
        $msg = "Passwords do not match";
        // 2) Redirect user to register.php
        $_SESSION['error'] = $msg;

        header("Location: register.php");
        exit;
    }
    else {
        // Passwords do match so proceed with registration!
        $dao = new AccountDAO();

        //Verify is there is an existing user in the database
        $verifyEmail = $dao->verifyEmail($email);

        if($verifyEmail){
            $msg = "This User already exist!";
            $_SESSION['error'] = $msg;
            // 2) Redirect user to login.php
            header("Location: register.php");
            exit;
        }
        

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $result = $dao->register($email,$fullname,$hashed_password,$categories_string);
        // var_dump($result);
        // exit;

        if ($result) {
            // If registration in Account table was SUCCESSFUL
            // 1) Register Success message
            //    This message will be accessed from login.
            $msg = "User $fullname has been successfully registered!";
            $_SESSION['success'] = $msg;
            // var_dump($_SESSION);
            // exit;
            // 2) Redirect user to login.php
            header("Location: login.php");
            exit;
        }
        else { 
            // If registration in Account table was NOT SUCCESSFUL
            // 1) Register Error message
            $msg = "User $fullname could not be registered!";
            $_SESSION['error'] = $msg;
            // 2) Redirect user to login.php
            header("Location: register.php");
            exit;
        }
    }
}
else {

    // 1) Register Error message as a Session Variable
    $msg = "All 5 fields must be filled out";
    $_SESSION['error'] = $msg;
    if(!empty($_POST['categories'])){
        $_SESSION['categories'] = $_POST['categories'];
    }

    // 2) Redirect user to register.php
    header("Location: register.php");
    exit;
}
?>