<?php

require_once "include/common.php";

$email = $_POST['email'];
$categories_array = $_POST['categories'];
$categories_string = implode(",", $categories_array);

// var_dump($categories_string);

$dao = new AccountDAO();
$user_id = $dao->getUserId($email);

$dao->updatePreference($user_id, $categories_string);

$_SESSION['success'] = 'Preferences successfully updated!';

header("Location: itineraries.php");
exit;

?>