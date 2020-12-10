<?php

// YOUR CODE GOES HERE
require_once "include/common.php";

// Unsetting or removing the current session (in Memory)
unset($_SESSION['email']);
unset($_SESSION['fullname']);
unset($_SESSION['categories']);


// Destroying the current session (remove session file on web server)
session_destroy();

// Forward user to login.php
header("Location: login.php")

?>