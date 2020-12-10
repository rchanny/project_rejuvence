
<?php

// YOUR CODE GOES HERE
require_once "include/common.php";

// var_dump($_SESSION);

// Any 'error' message to display? (from process_login.php)
$error = '';
if(isset($_SESSION['error'])) {
    $error=$_SESSION['error'];
    unset($_SESSION['error']);
}
// Any 'success' message to display? (from process_register.php)
$success = '';
if(isset($_SESSION['success'])) {
   $success=$_SESSION['success'];
   unset($_SESSION['success']);
}

// Check if user is redirected here from 'My itineraries' in footer
if (isset($_GET['check'])) {
    $alert = true;
}
else {
    $alert = false;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom JavaScript -->
    <script src="js/index.js"></script>

    <!-- Search bar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Mukta+Malar:400,500,600'>

    <!-- Footer -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- SweetAlert Lib -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <title>Login Page</title>
</head>
<body>

    <div class=row>

   
    <!-- ================================================================ -->
    <!-- Navigation -->
    <div class='col-sm-12'>
        <div id='navigation'>
            <?php include('header.php') ?>
        </div>   
    </div>

    <div class='col-sm-12'>
        <p class="lead text-center" style="margin-top:100px; margin-bottom:60px;">Welcome back - log in!</p>
    </div>

    <div class='container'>
        <div class='col-sm-12' style="margin-bottom:80px;">
            <form action='process_login.php' method='POST' style="margin: auto">
                <div class='col-sm-12 mb-4'>
                    <div class="form-group">
                        <label for="emailInput">Email address</label>
                        <input class="form-control" id="emailInput" type='text' name='email' placeholder="Email">
                    </div>
                </div>

                <div class='col-sm-12' style="margin-bottom:70px;">
                    <div class="form-group">
                        <label for="passwordInput">Password</label>
                        <input class="form-control" id="passwordInput" type='password' name='password' placeholder="Password">
                    </div>
                </div>

                <div class='col-sm-12 mb-4'>
                    <div class="text-center mt-4">
                        <input type='submit' class="btn text-center orange_button" style="color:white; font-weight: 600; font-size: 15px; background-color: #f26c55;" value='Login'>
                    </div>
                </div>
            </form>

            <div class='col-sm-12'>
                <p class="lead text-center mt-4">Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>

            <div class='col-sm-12'>
                <?php
                    if( isset($error) ) {
                        if($error == ''){
                            echo "";

                        }else{
                            echo "
                                <div class='container' style='width:600px; margin:auto'>
                                    <p class='alert alert-danger text-center' >
                                        $error
                                    </p>
                                </div>
                            
                            ";
                        }
                    
                    }

                    if( isset($success) ) {
                        if($success == ''){
                            echo"";
                        }else{
                            echo "
                            <div class='container' style='width:600px; margin:auto'>
                                <p class='alert alert-success text-center' >
                                    $success
                                </p>
                            </div>
                            ";
                        }
                        
                    }
                ?>
            </div>
        </div>
    <!----------- End of Container ------------>    
    </div>

    <div class='col-sm-12'>
    <!----------- Footer ------------>
    <footer class="footer-bs" id="footer">
        <?php include("footer.php") ?>  
    </footer>
    </div>

    <!----------- End of Row ------------>
    </div>

    <script>

        var alert = <?php echo $alert ?>;

        if(alert) {
            swal("You have not log in yet!", "Please login to view your itineraries. Register if you do not have an account yet!","warning");
        };

    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
</body>
</html>

