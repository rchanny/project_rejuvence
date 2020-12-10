<?php

require_once "include/common.php";

$dao = new AccountDAO();

$itinerary_id = $_GET['itinerary_id'];
$start_time = $_GET['start_time'];
$date = $_GET['date'];

$user_id = $dao->getUserId($email);
$itinerary_name = $dao->getIndividualItineraryName($user_id, $itinerary_id);


$dao->deleteItineraryAttractions($start_time, $itinerary_id, $date);

$_SESSION['success'] = "Attraction has been successfully deleted from your itinerary";

header("Location: itinerary_view.php?iti_id=$itinerary_id&iti_name=$itinerary_name");
exit;

?>