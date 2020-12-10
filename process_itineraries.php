<?php 
require_once "include/common.php";

$webpage = $_GET['page'];
$webpage = str_replace('*','&',$webpage);

if(trim($_POST['itinerary_name']) != '' ){
   
    $itinerary_name = $_POST['itinerary_name'];

    // var_dump($itinerary_name);
    $user_id = $_POST['user_id'];

    // var_dump($user_id);
    $dao = new AccountDAO();

    $result = $dao->createItinerary($user_id,$itinerary_name);

    if ($result) {
      
        $msg = "Itinerary has successfully been created!";
        $_SESSION['success'] = $msg;
        // var_dump($_SESSION);
        // exit;
        // 2) Redirect user to test.php
        header("Location: ".$webpage);
        exit;
    }

    else { 
        // If registration in Account table was NOT SUCCESSFUL
        // 1) Register Error message
        $msg = "Itinerary cannot be created";
        // $_SESSION['error'] = $msg;
        // var_dump($_SESSION);
        // 2) Redirect user to login.php
        header("Location: ".$webpage);
        exit;
    }


}

else{

    $msg = "Itinerary Name cannot be empty";
    $_SESSION['error'] = $msg;
    // var_dump($_SESSION);
    header('Location: '.$webpage);
    exit;

}


?>