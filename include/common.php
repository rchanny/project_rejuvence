<!--

    DO NOT MODIFY THIS FILE

-->
<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

session_start();


$dao = new AccountDAO();

$login_check = false;
$categories = '';
            

if( isset($_SESSION['email']) ) {

    $email = $_SESSION['email'];
    $fullname = $dao->getName($email);
    $categories = $dao->getCategories($email);
    $login_check = true;
    $login_check = $_SESSION['login_check'];
    
};

function printErrors() {
    if(isset($_SESSION['errors'])){
        print "<ul style='color:red;'>";
        
        foreach ($_SESSION['errors'] as $value) {
            print "<li>" . $value . "</li>";
        }
        
        print "</ul>";   
        unset($_SESSION['errors']);
    }    
};

?>