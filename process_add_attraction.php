<?php 
require_once "include/common.php";

// var_dump($_POST);
$uuid = $_POST['uuid'];
$category = $_POST['category'];
$selected_attraction_name = $_POST['attraction_name'];

$msg = '';

if (!$login_check) {
    header("Location: login.php?check=");
    exit;
}


// Check if user selected itinerary & date
if (!isset($_POST['itinerary_id']) || $_POST['date'] == '') {
    
    $msg = '
    Please fill in the fields of the following:
    ';

    if (!isset($_POST['itinerary_id'])) {
        $msg .= '
            - Itinerary ';
        $_POST['itinerary_id'] = '';
    } 
    if ( $_POST['date'] == '') {
        $msg .= '
            - Date';
    }

}

// Get all attraction within user's selected itinerary and check if the timing overlaps
else {

    $itinerary_id = $_POST['itinerary_id'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $day = substr($date, 0, 2) ;
    $month = substr($date, 3, 2) ;
    $year = substr($date, 6, 4) ;

    $date = $year . "-" . $month ."-" . $day ; 

    $dao = new AccountDAO();
    $attractions_array = $dao->getItineraryAttractions($itinerary_id);

    // Loop through each existing attraction to see if there is any overlap 
    // var_dump(count($attractions_array));

    if (count($attractions_array) == 0) {
        $dao->createItinerariesItem($itinerary_id, $uuid, $selected_attraction_name, $category, $date, $start_time, $end_time);
        $_SESSION['success'] = 'Attraction has been added!';
    }

    else {

        foreach ($attractions_array as $attraction){

            // var_dump($attraction);
            $attraction_date = $attraction['itinerary_date']; 
            $attraction_name = $attraction['attraction_name'];
    
            // Only check for attractions within the same date
            if ($date == $attraction_date) {

                $attraction_start_time = $attraction['START_TIME'];
                $attraction_end_time = $attraction['END_TIME'];

                // var_dump($start_time.":00" == $attraction_start_time);
                
                // Check if any start time clashes 
                if ($start_time.':00' == $attraction_start_time) {

                    $msg = "Your current selection has the same start time as '$attraction_name' which starts at $attraction_start_time and end at $attraction_end_time";
                    break;

                }
                
                // Check if selected attractions starts before another attraction ends
                else if ($start_time.':00' > $attraction_start_time && $start_time.":00" < $attraction_end_time) {

                    $msg = "Your current selection is starting before the end time of '$attraction_name' which starts at $attraction_start_time and end at $attraction_end_time";
                    break;
                }

                // Check if any attractions which starts before selected attraction ends
                else if ($start_time.':00' < $attraction_start_time && $end_time.":00" > $attraction_start_time) {
                    
                    $msg = "Your current selection is ending after the start time of '$attraction_name' which starts at $attraction_start_time and end at $attraction_end_time";
                    break;
                }
            }
        }

        if (empty($msg)) {
            
            $dao->createItinerariesItem($itinerary_id, $uuid, $selected_attraction_name, $category, $date, $start_time,$end_time);
            $_SESSION['success'] = 'Attraction has been added!';

        }

    }

    // var_dump($attractions_array);

}


// echo $msg;
// If there are error msg, will add to session variable and pass back to details page
if ($msg) {

    $_SESSION['msg'] = $msg;
    $_SESSION['itinerary_id'] = $_POST['itinerary_id'];
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['start_time'] = $_POST['start_time'];
    $_SESSION['end_time'] = $_POST['end_time'];

}


header("Location: details.php?category=$category&uuid=$uuid");
exit;

?>