<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <style>
        
        #header {
            background-image: url("images/aboutus_img/singapore.jpg") ;
            text-align: center ;
            height: 280px;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: 100% 100%;
        }

        #header h1 {
              color: #fff;
              padding-top: 50px;
              text-shadow:3px 3px black;
              font-size: 45px;
              font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .img-thumbnail {
            border-radius: 50% ;
            height: 200px;
            width: 180px;
        }

        #about_us p, .teammates p{
            text-align: center ;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 10px;
            line-height: 1.6;
        }
         
        #team_picture .row p{
            font-weight: bold;
        }

        #team_header {
            padding-top: 20px ; 
            padding-bottom: 40px; 
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 30px;
            text-align: center;
        }

        #about_us h5{
            font-weight: bold;
            font-size: 20px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        
    </style>

    <title>About Us</title>
  </head>

  <body>
    <!-- Navigation Bar -->
    <!-- ================================================================ -->

    <!-- Navigation -->
    <?php include('header.php') ?>


    <!--Jumbotron-->
    <div class="jumbotron" id="header">

        <h1 >About Team REJUVENCE</h1>

    </div>

    <!--About Us Infromation-->
    <div class='container' id="about_us">
        <h5>Our Mission</h5>
        <p style="text-align: justify; font-style: italic;">
            The word 'rejuvenece' means to restore, or revive. Our team - Team Rejuvenence hopes that through providing users with a platform to explore what the local tourism industry has to offer and to plan their itineraries, we are able to help restore and revive Singapore's local tourism scene which has been deeply affected by the COVID-19 pandemic.
        </p>
        <h5>Our Story</h5>
        <p style="text-align: justify; font-style: italic; margin-bottom: 50px;">
            We are a group of students studying in the School of Information Systems at SMU. We have created this website for our Web Application Development module and we hope our professors will like it!
        </p>
    </div>
    

    <!--Pictures of our TEAM-->
    <div class="container-fluid" style="background-image: url(images/aboutus_img/background.jpg); padding: 30px 15px 30px 15px;">
        <h2 id="team_header">A Passionate Team - Team REJUVENCE</h2>
        
        <div class="container" id="team_picture">
            <!--PICTURES of the TEAM-->
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="container teammates" style="justify-content: center;">
                        <img src="images/aboutus_img/jianzhii.jpg" alt="..." class="img-thumbnail mx-auto d-block">
                        <br>
                        <p>Jian Zhi</p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="container teammates" style="justify-content: center;">
                        <img src="images/aboutus_img/ryan.jpg" alt="..." class="img-thumbnail mx-auto d-block">
                        <br>
                        <p>Ryan</p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-xl-4">
                    <div class="container teammates" style="justify-content: center;">
                        <img src="images/aboutus_img/javier.jpg" alt="..." class="img-thumbnail mx-auto d-block">
                        <br>
                        <p>Javier</p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-6" >
                    <div class="container teammates" style="justify-content: center;">
                        <img src="images/aboutus_img/mayuri.jpg" alt="..." class="img-thumbnail mx-auto d-block">
                        <br>
                        <p>Mayuri</p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-6">
                    <div class="container teammates" style="justify-content: center;">
                        <img src="images/aboutus_img/ruolin.png" alt="..." class="img-thumbnail mx-auto d-block">
                        <br>
                        <p>Ruolin</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!----------- Footer ------------>
    <footer class="footer-bs" id="footer">
        <?php include("footer.php") ?>  
    </footer>
    <!-- Footer -->
        


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>