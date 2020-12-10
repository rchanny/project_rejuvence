
<?php             
    require_once "include/common.php";
?>


<!-- Vue.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<!-- Custom JavaScript -->
<script src="js/index.js"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Codes to display the header -->

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container" style="margin-bottom:15px; margin-top:15px;padding:0;">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand"><img src="images/logo2.png" style="width:90%; height:auto; cursor: pointer" onclick="location.href='index.php'"></a>

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 28" id="path"  style='cursor: pointer'>
                    <path d="M32.9418651,-20.6880772 C37.9418651,-20.6880772 40.9418651,-16.6880772 40.9418651,-12.6880772 C40.9418651,-8.68807717 37.9418651,-4.68807717 32.9418651,-4.68807717 C27.9418651,-4.68807717 24.9418651,-8.68807717 24.9418651,-12.6880772 C24.9418651,-16.6880772 27.9418651,-20.6880772 32.9418651,-20.6880772 L32.9418651,-29.870624 C32.9418651,-30.3676803 33.3448089,-30.770624 33.8418651,-30.770624 C34.08056,-30.770624 34.3094785,-30.6758029 34.4782612,-30.5070201 L141.371843,76.386562" transform="translate(83.156854, 22.171573) rotate(-225.000000) translate(-83.156854, -22.171573)"></path>
                </symbol>
            </svg>


            <div class="navbar-right"> 
                <!-- pull-right keeps the drop-down in line -->
                <ul class="nav navbar-nav pull-right">

                    <li class="nav-item" id="searchbar">

                        <!-- Search bar -->
                        <div class="search">
                            <input type="text" placeholder=" " id='searchbar_input'>

                            <div>
                                <svg> <use xlink:href="#path"> </svg>
                            </div>

                        </div>

                    </li>

                </ul>
            <!-- End of Div for navbar-right -->
            </div>

            <div class="collapse navbar-collapse navbar-left" id="navbarResponsive">
                <ul class="navbar-nav">

                    <!-- About us link -->
                    <li class="nav-item">
                        <button type="button" id='about_btn' class="btn btn-light btn-md" style="font-weight: 600; font-size: 15px; color: black; margin-right:20px;" onclick="location.href='aboutus.php'">About Us</button>
                    </li>

                    <?php
                        if ($login_check) {

                            echo '
                            <!-- My itineraries link -->
                            <li class="nav-item">
                                <button type="button" id=\'my_itineraries_btn\' class="btn btn-light btn-md" style="font-weight: 600; font-size: 15px; color: black; margin-right:30px;" onclick="location.href=\'itineraries.php\'">My Itineraries</button>
                            </li>
        
                            <!-- Profile link -->
                            <li class="nav-item dropdown">
                                
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=
                                \'padding: auto;\'>
                                    <img src="images/profilepic.png" style="max-width:40%; margin-left: auto; margin-right: auto">
                                </a>
        
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:orange;">
                                    <a class="dropdown-item" onclick="location.href=\'itineraries.php\'">Profile Info</a>
                                    <a class="dropdown-item" onclick="location.href=\'logout.php\'">Log out</a>
                                </div>
        
                            </li>';

                        }

                        else {

                            echo '                    
                            <!-- Login link -->
                            <li class="nav-item">
                                <button type="button" id=\'login_btn\' class="btn btn-light btn-md" style="font-weight: 600; font-size: 15px; color: black; margin-right:30px;" onclick="location.href=\'login.php\'">Login</button>
                            </li>

                            <!-- Register link -->
                            <li class="nav-item">
                                <button type="button" id=\'register_btn\' class="btn btn-md rounded orange_button" style="font-weight: 600; font-size: 15px; background-color: #f26c55; color:white;" onclick="location.href=\'register.php\'">Register</button>
                            </li>';
                        
                        }
                    ?>


                </ul>
            </div>

                    

        <!-- end of container div -->
        </div>

        <script>
            $("#searchbar_input").keyup(function(event) {
                if (event.keyCode === 13) {
                    
                    var keyword = document.getElementById('searchbar_input').value;
                    window.location.href = `index.php?search='${keyword}'`;
                }
            });
        </script>
        
    </nav>
