<?php 
require_once "include/common.php";

if(trim($_POST['profile_name']) != '' ){
   
    $profile_name = $_POST['profile_name'];

    $email = $_POST['email'];

    $dao = new AccountDAO();

    $result = $dao->updateProfileName($email,$profile_name);

    if ($result) {
      
        $msg = "Profile Name has successfully been Updated!";
        $_SESSION['success'] = $msg;
        // var_dump($_SESSION);
        // exit;
        // 2) Redirect user to test.php
        header("Location: itineraries.php");
        exit;
        
    }
    else { 
        // If registration in Account table was NOT SUCCESSFUL
        // 1) Register Error message
        $msg = "Profile Name cannot be created";
        $_SESSION['error'] = $msg;
        // var_dump($_SESSION);
        // 2) Redirect user to login.php
        header("Location: itineraries.php");
        exit;
    }


}else{
    $msg = "Profile Name cannot be updated";
    $_SESSION['error'] = $msg;
    // var_dump($_SESSION);
    header('Location: itineraries.php');
    exit;
}








?>