<?php 

    require_once "include/common.php";
    
    if(!isset($_SESSION['email'])) {
        header("Location: login.php?check=");
    }

    else {

        $success_msg = '';
        $error_msg='';
    
        if(isset($_SESSION['error'])) {
            $error_msg=$_SESSION['error'];
            
            unset($_SESSION['error']);
        }
    }

    
    if(isset($_SESSION['success'])) {
        $success_msg=$_SESSION['success'];
        
        unset($_SESSION['success']);
    }
    
    if( isset($_SESSION['email']) ) {
    
        $email = $_SESSION['email'];
      
    };

    //var_dump($fullname);
    $dao = new AccountDAO();

    $id = $dao->getUserId($email);
    $fullname = $dao->getName($email);
    $categories_string = $dao->getCategories($email);

    //var_dump($id);
    $itinerary_details = $dao->getItineraryNameAndID($id);

    $categories_array= [
        "Accomodations" => "accommodation",
        "Events"=> "event",
        "Bars & Clubs" => "bars_clubs",
        "Attractions"=>"attractions",
        "Tours"=>"tour",
        "Shopping"=>"shops" , 
        "Food & Drinks"=> "food_beverages", 
        "Walking Trails"=>"walking_trail"
    ]; 

    $categories_array_inverse = [
        "accommodation" => "Accomodations",
        "event" => "Events",
        "bars_clubs" => "Bars & Clubs",
        "attractions" => "Attractions",
        "tour" => "Tours",
        "shops" => "Shopping", 
        "food_beverages" => "Food & Drinks",
        "walking_trail" => "Walking Trails"
    ];
    
    // Changing categories string from DB into list 
    $preference_array = explode(',', $categories_string);
    $categories = '<div class="row">';
    foreach ($preference_array as $preference) {
        $categories .= "<div class='col-6 mb-3'>$categories_array_inverse[$preference]</div>";
    }
    $categories .= '</div>';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Preferences Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom JavaScript -->
    <script src="js/index.js"></script>

    <!-- Search bar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Mukta+Malar:400,500,600'>

    <!-- Footer -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!-- Vue JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    
    <!-- SweetAlert Lib -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    


    <title>User Itineraries </title>

    <style>
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
        
        #itineraryCont{
            margin-bottom:50px;
        }
        
        #my_iti_header{
            margin-top: 20px;
        }

        .edit:hover {
           color:black;
           transform: scale(1.3);
           transition: transform .5s ease;

            }
        .edit{
            color:grey;
        }
    </style>

    

</head>


<body>

<!-- ================================================================ -->

<!-- Navigation -->
<div id='navigation'>
        <?php include('header.php') ?>
</div>

<!-- Start of Row -->
<div class='row m-0'>

    <div class = 'col-sm-12'>
        <!-- Container for main content -->
        <div class="container mt-4">

            <div class="main-body">

                <!-- Row for personal info -->
                <div class="row gutters-sm">

                    <!-- Col for profile picture and name -->
                    <div class="col-md-4 mb-3 col-sm-12">

                        <!-- Card to display profile and name -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="images/Itineraries/profile_image.jpg" alt="Admin" class="rounded-circle" width="200">

                                    <div class="mt-3">
                                        <h4> <?php echo $fullname ?> </h4>
                                        <p class="text-secondary mb-1">Welcome to Rejuvence!</p>
                                        <p class="text-muted font-size-sm">Singapore</p>
                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#updateName">Edit Profile Name</button>

                                        <!-- Modal to edit profile name --> 
                                        <div class="modal fade" id="updateName" style="margin-top:50px;" tabindex="-1" role="dialog" aria-labelledby="profileLabel" aria-hidden="true">

                                            <div class="modal-dialog" role="document">

                                                <div class="modal-content">

                                                    <!-- Modal header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="profileLabel">Customize Your Name</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Modal Content -->
                                                    <form action="process_name.php" method="POST">

                                                        <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="profile_name">New Profile Name</label>

                                                                    <div id="charCountWrap">
                                                                        <input type="text"  v-model='message' @keyup='charCount()' class="form-control" id="profile_name" name="profile_name" aria-describedby="profileHelp" >
                                                                        <small id="profileHelp" class="form-text text-muted">{{ totalcharacter }} / 12 characters</small>
                                                                    </div>

                                                                    <input id="email" name="email" type="hidden" value="<?php echo $email; ?>">
                                                                </div>
                                                        </div>

                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary" value="Change Name">
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Modal for editing profile name -->

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End of col for profile picture and name -->

                    <!-- Col for profile details -->
                    <div class="col-md-8 col-sm-12">

                        <div class="card mb-3">

                            <!-- Card to display information -->
                            <div class="card-body">

                                <!-- Row for fullname -->
                                <div class="row">   

                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>

                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $fullname ?>
                                        </div>
                                </div>

                                    <hr>

                                <!-- Row for email -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>

                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $email ?>
                                    </div>
                                </div>

                                    <hr>
                                
                                <!-- Row for location -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Location</h6>
                                    </div>
                                    
                                    <div class="col-sm-9 text-secondary">
                                        Singapore
                                    </div>
                                </div>
                                
                                    <hr>

                                <!-- Row for travel preference (categories) -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <span class="material-icons edit" style='cursor: pointer; position: absolute; margin-left: -30px;'data-toggle="modal" data-target="#updatePreference">
                                            create
                                        </span>
                                        <h6 class="mb-0">Travel Preferences </h6>
                                        
                                    </div>

                                    <div class="col-sm-9 text-secondary" id='preferences'>
                                        <?php echo $categories ?>
                                    </div>

                                    <!-- Modal to edit preferences --> 
                                    <div class="modal fade"  style="margin-top:50px;" id="updatePreference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog" role="document">

                                            <div class="modal-content">

                                                <!-- Modal header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="itineraryLabel">Edit your preferences</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <!-- Modal Content -->
                                                <form action="process_preference.php" method="POST">

                                                    <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="preferences"><b>New Preferences </b></label>

                                                                <div id="preferences">
                                                                    <?php 

                                                                        foreach($categories_array as $category => $value){

                                                                            if($category == "Accomodations" ){
                                                                                $icon = "<i class='material-icons green600 mt-1'>hotel</i>";
                                                                            }elseif($category == "Events"){
                                                                                $icon = "<i class='material-icons red600 mt-1'>meeting_room</i>";
                                                                            }elseif($category == "Bars & Clubs"){
                                                                                $icon = "<i class='material-icons purple600 mt-1'>local_bar</i>";
                                                                            }elseif($category == "Attractions"){
                                                                                $icon = "<i class='material-icons yellow600 mt-1'>location_city</i>";
                                                                            }elseif($category == "Tours"){
                                                                                $icon = "<i class='material-icons pink600 mt-1'>airport_shuttle</i>";
                                                                            }elseif($category == "Shopping"){
                                                                                $icon = "<i class='red600 material-icons mt-1'>shopping_cart</i>";
                                                                            }elseif($category == "Food & Drinks"){
                                                                                $icon = "<i class=' orange600 material-icons mt-1'>fastfood</i>";
                                                                            }elseif($category == "Walking Trails"){
                                                                                $icon = "<i class='material-icons blue600 mt-1'>follow_the_signs</i>";
                                                                            }else{
                                                                                $icon = "<i class='material-icons mt-1'>house</i>";
                                                                            }
                                                                            echo "
                                                                                <div class='custom-control custom-checkbox'>
                                                                                    <input id='$category'  type='checkbox' name='categories[]' value='$value'>
                                                                                    <label  for='$category'>$category  $icon </label> 
                                                                            
                                                                                </div>
                                                                                
                                                                                ";
                                                                        }
                                                                    ?>

                                                                </div>

                                                                <input id="email" name="email" type="hidden" value="<?php echo $email; ?>">
                                                            </div>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-primary" value="Update Preference">
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Modal for editing profile name -->

                                </div>
                        
                            </div>
                            <!-- End of cards -->

                        </div>
                    
                    </div>
                    <!-- End of col for profile details -->

                </div>
                <!-- End of row for personal information -->

            </div>
            <!-- End of container for main body -->
            
            <!-- Container for itineraries -->
            <div class="container">


                <!-- Heading for my itineraries section -->
                <div class=col-sm-13 id="my_iti_header">
                <span style="font-size:60px;">
                    <h1 class="text-center"><span>My Itineraries</span></h1>
                </span>
                </div>

                <div class=col-sm-13>

                <!-- Row to contain all itineraries -->
                <div id="itineraryCont" class="ml-1 row">
                    
                    
                    <!-- Col for one itinerary card -->
                    <div class="col-xs-4">

                        <!-- Card to create itineraries -->
                        <div class="card mt-4 mr-3 " style="width: 17rem;">
                            <div class="card-body">
                                <h5 class="card-title d-inline">Create Itinerary</h5>
                                <button style="border:none; background-color:white;"  type="button"  data-toggle="modal" data-target="#createItinerary">
                                    <img  src="images/round_add_circle_black_18dp.png">
                                </button>
                                <p class="card-text mt-3">Your weekend getaway is just one click away</p>
                                <!-- Button trigger modal -->  
                            </div>
                        </div>

                    </div>
                    <!-- End of col for one itinerary card -->
        
                </div> 
                <!-- End of row for all itineraries -->

            </div>

        </div> 

    </div>

<!-- End of Row -->
</div>

    <!-- End of container for itineraries -->

    <!-- Modal to create itineraries -->
    <div class="modal fade" style="margin-top:50px;" id="createItinerary" tabindex="-1" role="dialog" aria-labelledby="itineraryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="itineraryLabel">Create an itinerary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Content -->
                <form action="process_itineraries.php?page=itineraries.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="itinerary_name">Itinerary Name</label>
                            <div id="charCountWrap2">
                                <input type="text"  v-model='message' @keyup='charCount()' class="form-control" id="itinerary_name" name="itinerary_name" aria-describedby="itineraryHelp" >
                                <small id="itineraryHelp" class="form-text text-muted"> {{totalcharacter}} / 50 characters</small>
                            </div>
                            <input id="user_id" name="user_id" type="hidden" value="<?php echo $id; ?>">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Let's Go">
                    </div>
                </form>
                
            </div>
            <!-- End of modal content -->
        </div>
    </div>
    <!-- End of Modal -->

</div>
<!-- End of container for main content -->



        <!----------- Footer ------------>
        <footer class="footer-bs" id="footer">
            <?php include('footer.php') ?>
        </footer>
    </div>



        <!-- Script to populate itineraries -->
        <script text="text/javascript">


            // console.log('testing');
            // Displaying of error and success msg after processing in process_itineraries.php 

            var success_msg = "<?php echo $success_msg; ?>";
            var error_msg = "<?php echo $error_msg; ?>";

            if(success_msg !="" ){
                swal("Good News!",success_msg ,"success");
            }
            if(error_msg !=""){
                swal("So Sorry!",error_msg ,"error");
            }


            // console.log(itinerary_names);



            var itinerary_details = <?php echo json_encode($itinerary_details) ?>;
            // console.log(itinerary_details);

            // Display each itineraries in cards if exist in database
            if(itinerary_details.length !== 0){

                var html_str="";

                var itinerariesDiv = document.getElementById('itineraryCont');

                for(itinerary of itinerary_details) {

                    html_str += `
                    <!-- Col for one itinerary -->
                    <div class="col-xs-4">
                        <div class="card mt-4 mr-3 mb-2" style="width: 17rem; height:370px">
                            <img class="card-img-top" src="images/Itineraries/existing_itineraries.jpg" alt="existing itineraries">
                            <div class="card-body">
                                <h5 class="card-title">${itinerary['itinerary_name']}</h5>
                                <p class="card-text">Your Existing Itinerary</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" onclick="location.href='itinerary_view.php?iti_id=${itinerary['itinerary_id']}&iti_name=${itinerary['itinerary_name']}'">
                                    View Itinerary
                                </button>
                                <button type="button" class="mt-2 btn btn-danger" onclick="location.href= 'process_delete.php?itinerary_id=${itinerary['itinerary_id']}'"  >
                                    Delete Itinerary 
                                </button>
                            </div>
                        </div>
                    </div> 
                    <!-- End of col for one itinerary -->
                    ` ;
                }

                // console.log(html_str);
                itinerariesDiv.innerHTML += html_str;
                
            }       
                
            // Vue.js codes
            // Vue for editing profile name
            new Vue(
                { // javascript object
                    el: '#charCountWrap',

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
            )
            
            // Vue for creating itinerary
            new Vue(
                { // javascript object
                    el: '#charCountWrap2',
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
            )

        </script>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>