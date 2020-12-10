<?php 

require_once "include/common.php";

$dao = New AccountDAO ();
$user_id = $dao->getUserId($_SESSION['email']);

// Form Processing
$msg = '';
if(isset($_GET['itinerary_id'])){
    $itinerary_id=$_GET['itinerary_id'];
    $itinerary_id= intval($itinerary_id);
    $result=$dao->deleteItinerary($user_id, $itinerary_id);
    //var_dump($itinerary_id);
    if ($result) {
      
        $msg = "Itinerary has been deleted!";
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
        $msg = "Itinerary cannot be deleted!";
        $_SESSION['error'] = $msg;
        //var_dump($_SESSION);
        // 2) Redirect user to login.php
        header("Location: itineraries.php");
        exit;
    }
}


?>