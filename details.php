<!DOCTYPE html>
<html lang="en">
<head>

    <?php
        require_once "include/common.php";
        
        /* Get attraction information from php link */
        $uuid = $_GET['uuid'];
        $category = $_GET['category'];


        /* Get user details to call DAO function an check for existing itineries */
        $itinerary_array = [];

        if (isset($email)) {

            $dao = new AccountDAO();
            $user_id = $dao->getUserId($email);
            $itinerary_array = $dao->getItineraryNameAndID($user_id);

            // var_dump($itinerary_array);
        }

        $date = '';
        $start_time = '08:00';
        $end_time = '22:00';
        $selected_itinerary_id = '';
        $msg = '';

        if (isset($_SESSION['msg'])) {

            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);

            $start_time = $_SESSION['start_time'];
            unset($_SESSION['start_time']);

            $end_time = $_SESSION['end_time'];
            unset($_SESSION['end_time']);

            $date = $_SESSION['date'];
            unset($_SESSION['date']);

            $selected_itinerary_id = $_SESSION['itinerary_id'];
            unset($_SESSION['itinerary_id']);

            // var_dump($selected_itinerary_id);
            // var_dump($msg);
        }

        $success = '';
        if (isset($_SESSION['success'])) {
            $success = $_SESSION['success'];
            unset($_SESSION['success']);
        }

 


            

    ?>



    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
        
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Vue JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>


    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

    <!-- Clock -->
    <link rel="stylesheet" type="text/css" href="clock/jquery-clockpicker.min.css">

    <!-- SweetAlert Lib -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Internal CSS -->
    <style>
        /* Search bar css */
        .search input + div svg {
            stroke: black;
        }
        .search input {
            color:black;
        }

        .btn-white {
            font-weight: bold;
        }

        button.navbar-toggler{
            border-color: black;
        }
        .custom-select {
            background-color: rgb(228, 228, 228);
        }

        .custom-select option{
            background-color: white;
        }
        @media (max-width:768px){
            #recommendation_title{
                font-size:4vw;
            }
        }

        @media (max-width:600px){
            #recommendation_title{
                font-size:4.5vw;
            }
        }
    </style>
    <title>Activity</title>


</head>
<body onload='details_display( "<?=$category?>",  "<?=$uuid?>","details")'>

    <!-- ================================================================ -->
    <!-- Navigation -->
    <div id='navigation'>
        <?php include('header.php') ?>
    </div> 
    <hr style="margin:0;">

    <!-- Image w description -->
    <div class="jumbotron" style='padding:50px 40px 50px 40px; margin-bottom: 0;'>

        <div class="container-fluid mx-0" style='background-color: white; border-top:5px black; border-radius:10px'>

            <!-- Row for image, name and description -->
            <div class="row p-2">

                <div class="col-sm-6 " >
                    <img src='' style="max-width:100%; max-height: 100%;" id='attraction_image' onerror='replace_image(this)'>
                </div>

                <div class="col-sm-6 align-self-center">

                    <!-- Name -->
                    <h1 style="font-size: calc(24px + (26 - 14) * ((90vw - 300px) / (1600 - 300))); padding-top:25px; padding-left: 15px;" id='attraction_name'></h1>

                    <!-- Ratings -->
                    <div style='padding-left: 15px;' id='ratings'>
                    </div>

                    <!-- Description -->
                    <div style="padding-left: 15px; padding-top:20px; font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))" id='description'>
                    </div>
                </div>

            <!-- End of row for image, name and description -->
            </div>

            <!-- Row for category, address, contact, website -->
            <div class='row'>

                <!-- Col for category & address -->
                <div class="col-sm-6 align-self-center">

                    <div class="container">

                        <div style="padding-left: 15px; padding-top:20px; font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">

                            <!-- Category -->
                            <p style="font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">
                                <span class="fa fa-list"></span> 
                                <b> Category Type:</b> 
                                <p id='category'></p>
                            </p>

                            <!-- Address -->
                            <p style="font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">
                                <span class="fa fa-map-marker"></span> 
                                <b style="padding-left: 12px;">Address:</b> 
                                <p id='address'></p>
                            </p>

                        </div>

                    </div>
                <!-- End of col for category & address -->
                </div>

                <!-- Col for contact & website -->
                <div class="col-sm-6 align-self-center">

                    <div class="container">

                        <div style="padding-left: 15px; padding-top:20px; font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">

                            <!-- Contact -->
                            <p style="font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">
                                <span class="fa fa-address-book"></span> 
                                <b> Contact details:</b> 
                                <p id='contact'></p>
                            </p>

                            <!-- Website -->
                            <p style="font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">
                                <span class="fa fa-server"></span> 
                                <b style="padding-left: 12px;">Official Website:</b> 
                                <p id='website'></p>
                            </p>

                        </div>

                    </div>
                <!-- End of col for contact & website -->
                </div>

            <!--End of row for category, address, contact, website -->
            </div>

            <!-- Row for adding to itinerary -->
            <div class='row'>      

                <!-- Add to Itinerary -->

                <div class="container-fluid mt-5">
                
                    <hr style="height:1px; width: 90%; margin: auto;"> 

                    <h1 style="font-size: calc(24px + (26 - 14) * ((90vw - 300px) / (1600 - 300))); padding:20px 15px;">Plan In Your Itinerary</h1>

                    <div class="row" style="padding-left:15px;">
                        
                        <!-- Container for itinerary input fields -->
                        <div class='container-fluid'>
                            <form action="process_add_attraction.php" method="post">

                                <!-- Row to choose itinerary and date -->
                                <div class='row'>

                                    <!-- Choose Itinerary-->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="itinerary_add">Itinerary</label>
                                            <select class="custom-select" id="itinerary_add" name='itinerary_id' required>
                                                <option selected disabled value="none">Select itinerary to add to...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid itinerary.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Choose Date (if remove form tag it dies)-->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label " for="date">
                                            Select Date
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon mr-1">
                                                    <i class="fa fa-calendar-plus-o">
                                                    </i>
                                                </div>
                                            <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text" value="<?=$date?>">
                                            </div>
                                        </div>
                                    </div>
                                <!-- End of choose itinerary and date row -->
                                </div>
                                
                                <!-- Row for start and end time -->
                                <div class='row'>
                                    <!-- Choose Start Time -->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label " for="date">
                                                Start Time
                                            </label>
                                            <div class="input-group clockpicker" data-placement="top" data-align="left" data-donetext="Done">
                                                <input type="text" class="form-control" name='start_time' value="<?=$start_time?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Choose End Time -->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label " for="date">
                                                End Time
                                            </label>
                                            <div class="input-group clockpicker" data-placement="top" data-align="left" data-donetext="Done">
                                                <input type="text" class="form-control" name='end_time' value="<?=$end_time?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End of timings row -->
                                </div>

                                <!-- Submit -->
                                <div class="col-md-5 col-sm-12 p-0">
                                    <div class="form-group">
                                        <div>
                                            <button class="btn btn-primary " type="submit" onclick='location.href="process_add_attraction.php"'>
                                            Add to itinerary
                                            </button>
                                            
                                            <!-- Hidden value for uuid and category so page will display again after processing attraction addition -->
                                            <div id='hidden_values'>
                                                <input type='hidden' name='category' value="<?=$category?>">
                                                <input type='hidden' name='uuid' value="<?=$uuid?>">
                                                <input type='hidden' name='attraction_name' id='attraction_name_value'>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            
                            </form>
                        
                        </div>

                    </div>

                <!-- End of container for itinerary -->
                </div>

            <!-- End of Itinerary section -->   
                

            <!-- End of itinerary row -->
            </div>
            
        <!-- End of top section (attraction details and adding into itinerary) -->
        </div>

    <!-- End of top Jumbotron -->
    </div>

    
    <!-- Jumbotron for reviews -->
    <div class="jumbotron" style='padding:0px 40px 50px 40px; margin-bottom: 0;'>
        <div class="container-fluid mx-0 p-3" style='background-color: white; border-top:5px black; border-radius: 10px'>   
            <h1> Reviews </h1>
            <hr style="height:1px; width: 90%; margin: auto;"> 

            <div class='container-fluid' id='reviews'>
                <span style='color:grey;'>There are currently no reviews</span>
            </div>

        </div>
    </div>


    <!-- Div container to display attraction recommendation near location of attraction -->
    <div class="container" style='margin: auto; margin-top:50px; width: 80%; margin-bottom:50px;'>
            <h1 class="carousel_title">
                <span id='recommendation_title'></span>
            </h1>
            
        
            <div class='slider owl-carousel' id='recommendation' style="margin-top: 50px;">

            </div>
            
    </div>                          

    <!-- Modal to create itineraries -->
    <div class="modal fade in" style="margin-top:50px;" id="createItinerary" tabindex="-1" role="dialog" aria-labelledby="itineraryLabel">
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
                <form action="process_itineraries.php?page=details.php?category=<?=$category?>*uuid=<?=$uuid?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="itinerary_name">Itinerary Name</label>
                            <div id="charCountWrap2">
                                <input type="text"  v-model='message' @keyup='charCount()' class="form-control" id="itinerary_name" name="itinerary_name" aria-describedby="itineraryHelp" >
                                <small id="itineraryHelp" class="form-text text-muted"> {{totalcharacter}} / 50 characters</small>
                            </div>
                            <input id="user_id" name="user_id" type="hidden" value="<?php echo $user_id; ?>">
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
    
    <!----------- Footer ------------>
    <footer class="footer-bs" id="footer">
        <?php include('footer.php') ?>
    </footer>


    <!-- Owl Carousel JavaScript, CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

</body>


<!-- Clock -->
<script type="text/javascript" src="clock/jquery.min.js"></script>
<script type="text/javascript" src="clock/jquery-clockpicker.min.js"></script>
<script type="text/javascript">
$('.clockpicker').clockpicker()
	.find('input').change(function(){
		console.log(this.value);
	});
$('#single-input').clockpicker({
	placement: 'bottom',
	align: 'right',
	autoclose: true,
	'default': '20:48'
});
if (/Mobile/.test(navigator.userAgent)) {
	$('input').prop('readOnly', true);
}

</script>

<script type="text/javascript" src="clock/highlight.min.js"></script>
<script type="text/javascript">
hljs.configure({tabReplace: '    '});
hljs.initHighlightingOnLoad();
</script>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<?php


    $createItinerary = "<script>
    document.getElementById('itinerary_add').addEventListener('change', function (e) {";
    
    if (isset($user_id)) {
        $createItinerary .= "
            if (e.target.value === 'create_itinerary') {
                $('#createItinerary').modal('show');
            };
            });
        </script>";
    }
    else {
        $createItinerary .= "
        if (e.target.value === 'create_itinerary') {
            window.location.href = `login.php?check=`;
        };
        });
        </script>";
    }

    echo $createItinerary;

?>



<!-- For datepicker -->

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


<script type='text/javascript'>
    
    var msg = `<?php echo $msg?>`;
    var success = `<?php echo $success?>`;


    if(success != "" ) {
        swal("Good News!",success ,"success");
    }
    if(msg != ""){
        swal("So Sorry!",msg ,"error");
    }

    // Add in users itineraries if any
    var itineraries_array = <?php echo json_encode($itinerary_array) ?>;

    // console.log(itineraries_array);
    // Loop through array and add into dropdown options 
    for (itinerary of itineraries_array) {

        var selected_itinerary_id = '<?php echo $selected_itinerary_id ?>';
        var select = '';
        
        if (itinerary.itinerary_id === selected_itinerary_id) {
            select = 'selected';
        }

        // console.log(selected_itinerary_id);

        document.getElementById('itinerary_add').innerHTML += `<option ${select} value="${itinerary.itinerary_id}">${itinerary.itinerary_name}</option>`;
    }

    document.getElementById('itinerary_add').innerHTML += `<option value="create_itinerary"><span class='text-secondary'>Create New Itinerary</span></option>`;


    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })

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

</html>