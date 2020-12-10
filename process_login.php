<?php
require_once "include/common.php";

if( trim($_POST['email']) != '' && trim($_POST['password']) != '' ) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Authenticate
    $dao = new AccountDAO();

    // Call AccountDAO's getHashedPassword($username) to hashed_password stored in Account table
    $hashed_password = $dao->getHashedPassword($email);

    // See what getHashedPassword($username) returns.
    // var_dump($hashed_password);

    //    hashed_password (String) if username is found in Account table
   if($hashed_password != null){
       // If hashed_password (String) is found:
        // 1) Verify that $password (plain text) matches $hashed_password (encrypted)
        $is_Valid = password_verify($password,$hashed_password);
        
        if($is_Valid){
               // 2) If both passwords match:
                //    a) Save akl relevant session variables
                //    b) Redirect user to index.php
                $fullname = $dao->getName($email);
                $categories = $dao->getCategories($email);

                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['categories'] = $categories;
                $_SESSION['login_check'] = true;

                header("Location: index.php");
                exit;
                

        }else{
              // 3) If passwords DO NOT MATCH:
            $msg = "Incorrect Password!";
            //    a) Register Error message $msg as a Session Variable
            //    b) Redirect user to login.php
            $_SESSION['error'] = $msg;
            header("Location: login.php");
            exit;

        }

   }
   
   else{
        $msg = "Invalid Email/Password!";
        $_SESSION['error']=$msg;

        header("Location: login.php");
        exit;
   }

}
else {
    // Oh oh... both username/password fields must be filled out!

    // 1) Register Error message as a Session Variable
    $msg = "Please provide both email and password";
    $_SESSION['error']=$msg;

    // 2) Redirect user to login.php
    header("Location: login.php");
    exit;

}

?>