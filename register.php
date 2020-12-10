<?php

// YOUR CODE GOES HEREE
require_once "include/common.php";


// var_dump($_SESSION);

$msg = '';

if(isset($_SESSION['error'])) {
    $msg=$_SESSION['error'];

    unset($_SESSION['error']);
}

if(isset($_SESSION['categories'])) {
    $categoriesArr = explode(',', $_SESSION['categories']);

    unset($_SESSION['categories']);
}


$categories= [
    "Accomodations" => "accommodation",
    "Events"=> "event",
    "Bars & Clubs" => "bars_clubs",
    "Attractions"=>"attractions",
    "Tours"=>"tour",
    "Shopping"=>"shops" , 
    "Food & Drinks"=> "food_beverages", 
    "Walking Trails"=>"walking_trail",
];

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
    
    <title>Register</title>
    <style>
        .footer-bs {
            width:100%;
        }
         .red {
            border: 5px solid red;

        }
        .green{
            border: 5px solid green;
        }

        .material-icons.orange600 { color: #FB8C00; }
        .material-icons.red600 { color: #fd0000; }
        .material-icons.green600 { color: #61d248; }
        .material-icons.purple600 { color: #800080; }
        .material-icons.yellow600 { color: #eebf25; }
        .material-icons.pink600 { color: #fe3ad7; }
        .material-icons.blue600 { color: #4b87ed; }
        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 22px;  /* Preferred icon size */
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;

            /* Support for all WebKit browsers. */
            -webkit-font-smoothing: antialiased;
            /* Support for Safari and Chrome. */
            text-rendering: optimizeLegibility;

            /* Support for Firefox. */
            -moz-osx-font-smoothing: grayscale;

            /* Support for IE. */
            font-feature-settings: 'liga';
        }
        .search{
            margin-top:6px;
        }
        .btn-dark:hover{
    background-color: teal;
    color:white;
  }
    </style>
</head>
<body>
    
    <div class=row>
        

    <!-- ================================================================ -->
    <!-- Navigation -->
    <div class = col-sm-12>
        <div id='navigation'>
            <?php include('header.php') ?>
        </div>  
    </div>
    
    <div class='col-sm-12'>
        <div class="container container=fluid">
            <p class="lead text-center">Join now - it's free! </p>
            <p class="lead text-center mt-4">Already have an account? <a href="login.php">Log in</a></p>
        </div>
    </div>
   

    <div class= 'col-sm-12'>

    <?php
        if($msg == ''){
            echo "";

        }
        
        else{
            echo "
                <div class='container' style='width:600px; margin:auto'>
                    <p class='alert alert-danger text-center' >
                        $msg
                    </p>
                </div>
            ";
        }

    ?>
    </div>

    <div class='container my-3' style='margin:auto'>

        <div class='col-sm-12'>
        <form action='process_register.php' method='POST' style="margin: auto">
            <div class='col-sm-12'>
                <div class="form-group"> 
                    <label for="emailInput" >Email address</label>
                    <div id="emailWrap">
                        <input class="form-control" :class="validEmail(email) ? 'green': 'red'" v-model="email"  id="emailInput" type='email' name='email'  aria-describedby="emailHelp" value=""  placeholder="e.g. john@live.com" required>
                    </div>
                </div>
            </div>
            
            <div class='col-sm-12'>
                <div id="profileNameCountWrap" class="form-group"> 
                    <label for="fullnameInput" >Profile Name</label>
                    <input  v-model='message'  v-bind:class="message.length < 12 ? '' : 'red'" @keyup='charCount()' type='text' class="form-control" id="fullnameInput" aria-describedby="profileHelp"name='fullname' placeholder="Profile Name" required>
                    <small id="profileHelp" class="form-text text-muted"> {{totalcharacter}}/12 characters  </small>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>

            <div id="passwordCheck">
                <div class='col-sm-12'>
                    <div class="form-group"> 
                        <label for="passwordInput">Password </label>
                        <input class="form-control"  v-model="password"  id="passwordInput" type='password' name='password' placeholder="Password" required>
                    </div>
                </div>

                <div class='col-sm-12'>
                    <div class="form-group"> 
                        <label for="confirmpasswordInput"  >Confirm Password </label>
                        <input class="form-control"  v-bind:class="{'green': greenBox, 'red' : redBox}" @blur="validate()" v-model="confirm_password" id="confirmpasswordInput" type='password' name='confirm_password' placeholder="Re-enter Password" required>
                        <small v-if="showError">Passwords don't match!</small>
                    </div>
                </div>

            <p class="lead text-center">What excites you! &#128525; </p>
            <div class='col-sm-12'>
            <div class="form-check">
            <?php 
                foreach($categories as $category => $value){
                    $c="";
                    if(isset($categoriesArr)){
                        for($i=0; $i< count($categoriesArr);$i++){
                            if ($categoriesArr[$i] == $value){
                                $c='checked';
                            }
                        }
                    }
                    if($category == "Accomodations" ){
                        $icon = "<i class='material-icons green600 mt-1'>hotel</i>";
                    }
                    elseif($category == "Events"){
                        $icon = "<i class='material-icons red600 mt-1'>meeting_room</i>";
                    }
                    elseif($category == "Bars & Clubs"){
                        $icon = "<i class='material-icons purple600 mt-1'>local_bar</i>";
                    }
                    elseif($category == "Attractions"){
                        $icon = "<i class='material-icons yellow600 mt-1'>location_city</i>";
                    }
                    elseif($category == "Tours"){
                        $icon = "<i class='material-icons pink600 mt-1'>airport_shuttle</i>";
                    }
                    elseif($category == "Shopping"){
                        $icon = "<i class='red600 material-icons mt-1'>shopping_cart</i>";
                    }
                    elseif($category == "Food & Drinks"){
                        $icon = "<i class=' orange600 material-icons mt-1'>fastfood</i>";
                    }
                    elseif($category == "Walking Trails"){
                        $icon = "<i class='material-icons blue600 mt-1'>follow_the_signs</i>";
                    }
                    else{
                        $icon = "<i class='material-icons mt-1'>house</i>";
                    }
                    echo "<input class='form-check-input mt-3' id='$category' type='checkbox' name='categories[]' value='$value' $c> 
                        <label class='form-check-label' for='$category'>$category  $icon </label> 
                        <br> 
                        ";
                }
            
            ?>
            </div>
            </div>
            <div class="text-center">
                <input type='submit' class="btn mt-4 orange_button" style="color:white; font-weight: 600; font-size: 15px; background-color: #f26c55; margin-bottom:40px;" name="press" value='Sign Up'>
            </div>
        
        </form>
        </div>

    </div>
     <!---End of Row--->
     </div>

     <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
        })();
      
      new Vue(
                { // javascript object
                    el: '#emailWrap',
                    data:{ // can be array, numeric , string
                        email: "",
                    },
                    methods: { // can have multiple methods
                        validEmail: function(email){
                            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            return re.test(email);
                        }
                    }
                }
             ),
        new Vue(
                { // javascript object
                    el: '#profileNameCountWrap',
                    data:{ // can be array, numeric , string
                        message: "",
                        totalcharacter: 0
                    },
                    methods: { // can have multiple methods
                        charCount: function(){
                            this.totalcharacter = this.message.length;
                        }
                    }
                }
             ),
        new Vue({
            el:"#passwordCheck",
            data:{
                password:"",
                confirm_password:"",
                greenBox: false,
                redBox:false,
                showError:false
                
            },
            methods:{
                validate : function(){
                    if(this.password != this.confirm_password){
                        this.redBox=true;
                        this.greenBox=false;
                        this.showError=true;
                    }else{
                        this.redBox=false;
                        this.greenBox=true;
                        this.showError=false;
                    }
                }
            }
        })
                                
    
    </script>
    <!----------- Footer ------------>
    <footer class="footer-bs" id="footer">
        <?php include("footer.php") ?>  
    </footer>
    

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>