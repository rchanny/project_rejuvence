<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Use PHP to check if user has logged in, isset($_SESSION['username']) -->
    <?php 
        require_once "include/common.php";
        
        // var_dump($login_check);
    ?>


    <script>

        var categories= "";
        var login_check = <?php echo json_encode($login_check) ?>;


        if(login_check) {
            var categories = <?php echo json_encode($categories) ?>;
            // console.log(categories); 
        }

    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

    <!-- Weather: web-font --> 
    <link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    
    <!-- Weather icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <title>Home</title>

    <?php
        $onload = "display_default()";
        if (isset($_GET['search'])) {

            $search = $_GET['search'];
            $onload = "search_keyword($search)";
        }
    ?>

</head>
<body onload="<?=$onload?>">

    
    <!-- ================================================================ -->
    <!-- Navigation -->
    <div id='navigation'>
        <?php include('header.php') ?>
    </div>           

    <!-- Carousel (Slide Show) -->
    <div id="carousel">
        <div class="rows">
                <div  class="container-fluid" id="headcarousel_container" style="padding: 0;">
                    <div id="categories" class="carousel slide" data-ride="carousel">
                        <!-- indicators -->
                        <ul class="carousel-indicators">

                            <li data-target="#categories" data-slide-to="0" class="active bg bg-dark"><div class="indicator_title" >Attractions</div></li>
                            <li data-target="#categories" data-slide-to="1" class="bg bg-dark"><div class="indicator_title" >Accomodations</div></li>
                            <li data-target="#categories" data-slide-to="2" class="bg bg-dark"><div class="indicator_title" >Food & Drinks</div></li>
                            <li data-target="#categories" data-slide-to="3" class="bg bg-dark"><div class="indicator_title" >Bars & Clubs</div></li>
                            <li data-target="#categories" data-slide-to="4" class="bg bg-dark"><div class="indicator_title" >Events</div></li>
                            <li data-target="#categories" data-slide-to="5" class="bg bg-dark"><div class="indicator_title" >Shopping</div></li>
                            <li data-target="#categories" data-slide-to="6" class="bg bg-dark"><div class="indicator_title" >Walking Trails</div></li>
                            <li data-target="#categories" data-slide-to="7" class="bg bg-dark"><div class="indicator_title" >Tours</div></li>
                            
                        </ul>
                        <!-- The slideshow -->
                        <div id="slide_show" class="carousel-inner">

                            <div class="carousel-item active">
                                <img id="carousel_attractions" src="images/attractions/st_20160311_ljworld11_2130832.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading1">Attractions</h1>
                                    <p>Apple of my eye</p>
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('attractions')"><b>Explore</b></button>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img id="carousel_accomodations" src="images/Accomodations/1620253_19050909100074368285.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading2">Accomodations</h1>
                                    <p>Gotta love that comfort</p>
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('accommodation')"><b>Explore</b></button>
                                </div>                    
                            </div>
    
                            <div class="carousel-item">
                                <img id="carousel_food" src="images/food/mci_hokkien-mee.adapt.1900.1 - Copy.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading3">Food & Drinks</h1>
                                    <p>Live to eat</p>
                                    
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('food_beverages')"><b>Explore</b></button>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img id="carousel_bar" src="images/bar/bar.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading4">Bars & Clubs</h1>
                                    <p>While the night is still young</p>
                
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('bars_clubs')"><b>Explore</b></button>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img id="carousel_events" src="images/events/iu-love--poem-concert-20191.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading5">Events</h1>
                                    <p>Find out what Singapore has to offer</p>
                                    
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('event')"><b>Explore</b></button>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img id="carousel_shopping" src="images/shopping/4ab1944d51138159de26f561a4f5cafd.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading6">Shopping</h1>
                                    <p>Shop till you drop</p>
                                    
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('shops')"><b>Explore</b></button>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img id="carousel_nature" src="images/Nature trials/Webp.net-resizeimage-6-min - Copy.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading7">Walking Trails</h1>
                                    <p>A walk in the park</p>
                                    
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('walking_trail')"><b>Explore</b></button>
                                </div>
                            </div>
                            
                            <div class="carousel-item">
                                <img id="carousel_tours" src="images/tours/28895540-1080p.jpg" alt="">
                                <div class="carousel-caption">
                                    <h1 class="carousel_headings" id="slide_heading8">Tours</h1>
                                    <p>We all need some guidance in life</p>
                                    
                                    <button type="button" class="btn btn-lg" style="background-color:orange; color:white;" onclick="category_display('tour')"><b>Explore</b></button>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#categories" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#categories" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                    </div> <!-- End of carousel div -->
                </div> <!-- End of carousel-container div -->
            </div> <!-- End of rows div -->
        </div> <!-- End of carousel div -->
    </div>

    
    <!-- ================================================================ -->
    <!-- div for displaying of all the cards-->
    <div id='content_body'>

        <!-- ================================================================ -->
        <!-- Container to display the trending-->
        <div class="container" style='margin: auto; margin-top:50px; margin-bottom:50px; width:80%'>
            <h1 class="carousel_title"><span>Trending</span></h1>
            
        
            <div class='slider owl-carousel' id='trending' style="margin: auto; margin-top:50px">
          

            </div>
            
        </div> 
        <!-- End of Container div -->


        <!-- ================================================================ -->
        <!-- Container to display recommendations based on users indicated preference-->
        <div class='container' id='recommendations' style="width: 80%">


        </div>
        <!-- End of Container div -->


        <!-- ================================================================ -->
         <!-- ================================================================ -->
        <!-- To display weather-->
        <div class="container-fluid" style='margin-top:50px; background-color: #f26c55; margin-bottom:50px;'>

            <h2 style="width: 100%; text-align: center; margin: 10px 0 20px;">
                <span style="font-size:calc((.2em + 1vmin) + (.2em + 1vmax)); padding:5px 60px 10px 60px; color:white; background-color: orange;"> Weather Forecast</span>
            </h2>

            <div class="container-fluid" id="weather">

                <div class="row">

                    <!-- First card of weather -->
                    <div class="col-md-4">
                        <div class="container text-center" style="background-color: #6ebfc2;">
                          <h2 class="pt-2 pb-3 m-0" style="color:charcoal;" id="today_day"></h2>
                        </div>

                        <!-- Main Body -->
                        <div class="container main-info">
                            <div class="weather-top">

                                <!-- Big weather icon -->
                                <div class="weather-grids weather-mdl" id="today_icon" style="margin-right:20px">
                                </div>

                
                                <!-- Day information -->
                                <div class="weather-grids">
                                    <h3 class="weather_month" id="today_date_month"></h3>
                                    <h1 class="weather_day" id="today_date_day"></h1>
                                </div>


                                <!-- For spacing -->
                                <div class="clear"></div>

                            </div>

                            <div class="weather-bottom">	
                                <h4 id="today_desc" class="weather_desc"></h4>

                                <div class="container p-0">
                                    <p id="today_temp"></p>
                                </div>
                              
                                <div class="container add_container">
                                    <span id = "today_details" class="additional"></span>
                                </div>
                                <!-- For spacing -->
                                <div class="clear"></div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- End of first weather card -->
                    
                    <!-- Second card of weather -->
                    <div class="col-md-4">
                        <div class="container text-center" style="background-color: #6ebfc2;">
                          <h2 class="pt-2 pb-3 m-0" style="color:charcoal;" id="second_day"></h2>
                        </div>

                        <!-- Main Body -->
                        <div class="container main-info">
                            <div class="weather-top">	

                                <!-- Big weather icon -->
                                <div class="weather-grids weather-mdl" id="second_icon" style="margin-right:20px">
                                </div>


                                <!-- Day information -->
                                <div class="weather-grids">
                                    <h3 class="weather_month" id="second_date_month"></h3>
                                    <h1 class="weather_day" id="second_date_day"></h1>          
                                </div>

                                <!-- For spacing -->
                                <div class="clear"></div>

                            </div>

                            <div class="weather-bottom">	
                                <h4 id="second_desc" class="weather_desc"></h4>

                                <div class="container p-0">
                                    <p id="second_temp"></p>
                              
                                <div class="container add_container">
                                    <span id = "second_details" class="additional"></span>
                                </div>
                              
                                </div>
                                <!-- For spacing -->
                                <div class="clear"></div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- End of second weather card -->
                    
                    <!-- Third card of weather -->
                    <div class="col-md-4">
                        <div class="container text-center" style="background-color: #6ebfc2;">
                          <h2 class="pt-2 pb-3 m-0" style="color:charcoal;" id="third_day"></h2>
                        </div>

                        <!-- Main Body -->
                        <div class="container main-info">
                            <div class="weather-top">	

                                <!-- Big weather icon -->
                                <div class="weather-grids weather-mdl" id="third_icon" style="margin-right:20px">
                                </div>


                                <!-- Day information -->
                                <div class="weather-grids">
                                    <h3 class="weather_month" id="third_date_month"></h3>
                                    <h1 class="weather_day" id="third_date_day"></h1>                                    
                                </div>

                                <!-- For spacing -->
                                <div class="clear"></div>

                            </div>

                            <div class="weather-bottom">	
                                <h4 id="third_desc" class="weather_desc"></h4>
                                <div class="container p-0">
                                    <p id="third_temp"></p>
                              
                                <div class="container add_container">
                                    <span id = "third_details" class="additional"></span>
                                </div>
                              
                                </div>
                                <!-- For spacing -->
                                <div class="clear"></div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- End of third weather card -->

                </div>
                <!-- End of row -->

                <div class="row justify-content-md-center">
                
                    <!-- Fourth card of weather -->
                    <div class="col-md-4">
                        <div class="container text-center" style="background-color: #6ebfc2;">
                          <h2 class="pt-2 pb-3 m-0" style="color:charcoal;" id="fourth_day"></h2>
                        </div>

                        <!-- Main Body -->
                        <div class="container main-info">
                            <div class="weather-top">	

                                <!-- Big weather icon -->
                                <div class="weather-grids weather-mdl" id="fourth_icon" style="margin-right:20px">
                                </div>


                                <!-- Day information -->
                                <div class="weather-grids">
                                    <h3 class="weather_month" id="fourth_date_month"></h3>
                                    <h1 class="weather_day" id="fourth_date_day"></h1> 
                                </div>

                                <!-- For spacing -->
                                <div class="clear"></div>

                            </div>

                            <div class="weather-bottom">	
                                <h4 id="fourth_desc" class="weather_desc"></h4>

                                <div class="container p-0">
                                    <p id="fourth_temp"></p>
                              
                                <div class="container add_container">
                                    <span id = "fourth_details" class="additional"></span>
                                </div>
                                    
                                </div>
                                <!-- For spacing -->
                                <div class="clear"></div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- End of fourth weather card -->
                    
                    <!-- Fifth card of weather -->
                    <div class="col-md-4">
                        <div class="container text-center" style="background-color: #6ebfc2;">
                          <h2 class="pt-2 pb-3 m-0" style="color:charcoal;" id="fifth_day"></h2>
                        </div>

                        <!-- Main Body -->
                        <div class="container main-info">
                            <div class="weather-top">	

                                <!-- Big weather icon -->
                                <div class="weather-grids weather-mdl" id="fifth_icon" style="margin-right:20px">
                                </div>


                                <!-- Day information -->
                                <div class="weather-grids">
                                    <h3 class="weather_month" id="fifth_date_month"></h3>
                                    <h1 class="weather_day" id="fifth_date_day"></h1>     
                                </div>

                                <!-- For spacing -->
                                <div class="clear"></div>

                            </div>

                            <div class="weather-bottom">	
                                <h4 id="fifth_desc" class="weather_desc"></h4>

                                <div class="container p-0">
                                    <p id="fifth_temp"></p>
                              
                                <div class="container add_container">
                                    <span id = "fifth_details" class="additional"></span>
                                </div>
                              
                                </div>
                                <!-- For spacing -->
                                <div class="clear"></div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- End of fifth weather card -->

                </div>
                <!-- End of row -->

            </div>
            <!-- End container for weather cards -->
            
        </div> 
        <!-- End of container for weather section -->


        <!-- ================================================================ -->
        <!-- Container to display nearby attractions if user allow-->
        <div class="container container-fluid" style='margin: auto; margin-top:10px; width:80%'>
            <span style="font-size:60px;" id='nearby_heading'>
            </span>
            
            <div class='slider owl-carousel' id='nearby' style="margin-top: 50px;">

            </div>

        </div> 
        <!-- End of Container div -->
        

        <!-- ================================================================ -->
        <!-- To display articles-->
        <div class="container-fluid" id="rediscover_articles" style='margin:auto; margin-top:50px; background-color: #6ebfc2;'>

            <h2 style="width: 100%; text-align: center; margin: 10px 0 20px;">
                <span style="font-size:calc((.2em + 1vmin) + (.2em + 1vmax)); padding:5px 60px 10px 60px; color:white; background-color: orange;">Rediscover Singapore</span>
            </h2>
        
            <div class="container-fluid" style='margin:auto'>
                <!-- Card row -->
                <div class="slider owl-carousel p-0" id="article" style='margin:auto; margin-top: 50px; width: 80%'>
                    <!-- Article 1 -->
                        <div class="card p-0 mb-5">
                            <a href="https://blog.seedly.sg/free-singaporediscovers-voucher/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/Singaporediscover smart Towkay tourism.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Seedly</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://blog.seedly.sg/free-singaporediscovers-voucher/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center">Free $100 SingapoRediscovers Vouchers: What Can I Spend It On?</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 2 -->
                        <div class="card p-0 mb-5">
                            <a href="https://www.timeout.com/singapore/things-to-do/best-halloween-events-in-singapore" target="blank">
                                <img class="card-img-top article-image" src="images/articles/halloween.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Timeout</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://www.timeout.com/singapore/things-to-do/best-halloween-events-in-singapore" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> 5 Best Halloween Events in Singapore With Safe Distancing</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 3 -->
                        <div class="card p-0 mb-5">
                            <a href="https://thesmartlocal.com/read/quiet-date-ideas-singapore/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/date.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By TheSmartLocal</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://thesmartlocal.com/read/quiet-date-ideas-singapore/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> 7 Unique First Date Ideas for Introverted Couples in Singapore</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 4 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://mothership.sg/2020/10/jurassic-world-cafe-singapore/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/dino.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Mothership</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://mothership.sg/2020/10/jurassic-world-cafe-singapore/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> Jurassic World Pop-up Café Opening at Level 56 Of ION Orchard</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 5 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://mothership.sg/2020/11/gardens-by-the-bay-dandelion/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/Dandelion-5-by-NAKED-INC.-scaled.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Mothership</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://mothership.sg/2020/11/gardens-by-the-bay-dandelion/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> 2-metre Tall Interactive Dandelion Installation At Gardens by The Bay Till Nov. 15, 2020</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 6 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://www.timeout.com/singapore/bars-and-pubs/best-bars-in-singapore" target="blank">
                                <img class="card-img-top article-image" src="images/articles/bar.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Timeout</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://www.timeout.com/singapore/bars-and-pubs/best-bars-in-singapore" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> The 50 Best Bars in Singapore You Must Visit</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 7 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://thehoneycombers.com/singapore/best-boutique-hotels-in-singapore/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/hotel.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Honeycombers</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://thehoneycombers.com/singapore/best-boutique-hotels-in-singapore/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> Singapore’s Coolest Boutique Hotels for Instagrammable Rooms and Cosy Stays</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 8 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://www.silverkris.com/12-hidden-restaurants-in-singapore-that-even-hipsters-dont-know-about/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/SUP_Duck-ConfitPasta_Credit-Whitney-Lim_result.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By SilverKris</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://www.silverkris.com/12-hidden-restaurants-in-singapore-that-even-hipsters-dont-know-about/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> 15 Hidden Restaurants in Singapore That Even Hipsters Don’t Know About</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 9 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://www.thebestsingapore.com/best-shopping/best-budget-shopping-places-in-singapore/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/budget.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By TheBestSingapore</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://www.thebestsingapore.com/best-shopping/best-budget-shopping-places-in-singapore/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> 8 Best Budget Shopping Places In Singapore To Shop Till You Drop</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 10 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://www.klook.com/en-SG/blog/hiking-trails-singapore/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/hiking.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Klook</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://www.klook.com/en-SG/blog/hiking-trails-singapore/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> Hiking In Singapore : Gorgeous Hiking Trails Among Nature To Escape From The City</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 11 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://thetravelintern.com/geocaching-secret-spots-in-singapore/" target="blank">
                                <img class="card-img-top article-image" src="images/articles/Geocaching-1-1.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By The TravelIntern</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://thetravelintern.com/geocaching-secret-spots-in-singapore/" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> 11 Secret spots in Singapore we discovered via Geocaching</p>
                                </a>
                            </div>
                        </div>

                    <!-- Article 12 --> 
                        <div class="card p-0 mb-5">
                            <a href="https://www.mariefranceasia.com/travel/destination-accomplished/asia/historic-buildings-singapore-219047.html#item=1" target="blank">
                                <img class="card-img-top article-image" src="images/articles/heritage.jpg">
                            </a>
                            <div class="card-title">
                                <p class="card-text pt-3 text-center article-source">By Marie France Asia</p>
                            </div>
                            <div class="card-subtitle mb-2">
                                <a href="https://www.mariefranceasia.com/travel/destination-accomplished/asia/historic-buildings-singapore-219047.html#item=1" class="article-title" target="blank">
                                    <p class="card-text px-3 pt-3 text-center"> Old Heritage: 10 Historical buildings in Singapore you need to visit</p>
                                </a>
                            </div>
                        </div>

                </div>

            </div>
        </div>

    <!-- End of content body container -->
    </div>

    <!----------- Footer ------------>
    <footer class="footer-bs" id="footer" style="padding-bottom:0px; padding-top:5px">
        <?php include("footer.php") ?>  
    </footer>
    
    <!-- Footer Ends -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Owl Carousel JavaScript, CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <script>
        jQuery(document).ready(function() {
            jQuery('#article').owlCarousel({
                loop:true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
        
                navText : ["<i class='fa fa-chevron-left' style='color: #d15641'></i>","<i class='fa fa-chevron-right' style='color: #d15641'></i>"],
            
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true,
                        navText : ["<i class='fa fa-chevron-left' style='color: #d15641'></i>","<i class='fa fa-chevron-right' style='color: #d15641'></i>"]
                    },
                    576:{
                        items:2,
                        nav:true,
                        navText : ["<i class='fa fa-chevron-left' style='color: #d15641'></i>","<i class='fa fa-chevron-right' style='color: #d15641'></i>"]
                    },
                    992:{
                        items:3,
                        nav:true,
                        navText : ["<i class='fa fa-chevron-left' style='color: #d15641'></i>","<i class='fa fa-chevron-right' style='color: #d15641'></i>"]
                    },
                }
            });

        });
    </script>


    <!-- Google Geolocation API -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcDXHEmpmXuho15izdAmXVuIzNNjEv4UI">  
    </script>

    <!-- Script to animate the icons -->
    <script>
        var icons = new Skycons({"color": "#FFD700"}),
            list  = [
                "clear-day"
            ],
            i;

        for(i = list.length; i--; )
            icons.set(list[i], list[i]);

        icons.play();

        var icons = new Skycons({"color": "#f5f5f5"}),
            list  = [
                "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for(i = list.length; i--; )
            icons.set(list[i], list[i]);

        icons.play();

    </script>

    <?php

        if(isset($search)) {
            echo "<script>       
            document.getElementById('content_body').scrollIntoView(true);
            </script>";
        }

        if(isset($_GET['category'])) {
            $category = $_GET['category'];
            
            echo"
            <script>
              category_display('$category');
            </script>";
      
        }

    ?>

</body>
</html>