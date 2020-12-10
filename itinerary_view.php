<?php 
    require_once "include/common.php";

    $success = '';
        
    if(isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
            
        unset($_SESSION['success']);
    }
        
    if( isset($_SESSION['email']) ) {
        
        $email = $_SESSION['email'];
          
    };

    $dao = new AccountDAO() ;

    $id = $dao->getUserId($email) ;
    $iti_id = $_GET['iti_id'] ;
    $iti_name = $_GET['iti_name'] ;
        
    $attractions = $dao->getItineraryAttractions($iti_id) ;
    
    // var_dump($attractions);


    $UniqueDates = [] ;

    for ($i = 0 ; $i<count($attractions) ; $i++) {
      $attraction = $attractions[$i] ;
      foreach ($attraction as $key=>$val) {
        // get unique dates in the array
        if ($key == 'itinerary_date') {
          $value = $attraction['itinerary_date'] ;
          if (!in_array($value,$UniqueDates)) {
          // look for unique dates in the inventory
            $UniqueDates[] = $value ;
          }
        }
      }
    }

    // var_dump($UniqueDates);
    
    $compile = [] ;


    for ($j = 0 ; $j<count($UniqueDates) ; $j++) {
      $date = $UniqueDates[$j] ;
      $attraction_of_specific_date = [];
      foreach ($attractions as $attraction) {
        if ($attraction['itinerary_date'] == $date) {
          $attraction_of_specific_date[] = $attraction;
        }
      }
      $compile[] = $attraction_of_specific_date ;
    }
    // var_dump($compile);
    

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>View Itinerary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
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
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- SweetAlert Lib -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <!-- Internal CSS-->
  <style>
  @import url("https://fonts.googleapis.com/css?family=Exo+2:400,700&subset=cyrillic");
  @import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");

    /* Day timeline */
    html {
  box-sizing: border-box;
}

*
*::before,
*::after {
  box-sizing: inherit;
}

body {
  font-family: 'Exo 2', sans-serif;
  line-height: 1.5;
}

.title {
  font-size: calc(24px + (26 - 14) * ((90vw - 300px) / (1600 - 300)));
}

.wrapper {
  margin: 0;
  padding: 0 10% 50px;
  margin-left:19%;
  width: 100%;
  zoom:65%;
}

.milestone {
  margin-left: 1%;
  position: absolute;
  color: white;
  font-weight: bold;
  font-family: 'Montserrat', sans-serif;
  font-size: calc((1em + .2vmin) + (1em + .2vmax));
  text-align: center;
  margin-top: 210px;
}

.milestone span{
  border-radius:50px;
}

article {
  position: relative;
  max-width: 980px  ;
  margin: 0 0 0 3%;
}



/* Timeline individual dates specific timing duration */

.wrapper .container ul {
  margin: 0;
  margin-top: 30px;
  list-style: none;
  position: relative;
  padding: 1px 100px;
  color: black;
  font-size: 13px;
}
.wrapper .container ul:before {
  
}
.wrapper .container ul li {
  position: relative;
  margin-top: 340px;
  background-color: rgba(255, 255, 255, 0.2);
  padding: 14px;
  border-radius: 6px;
  width: 1000px;
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.12), 0 2px 2px rgba(0, 0, 0, 0.08);
}

.wrapper .container ul li:before {
  content: "";
  width: 1px;
  height: 100%;
  position: absolute;
  border-left: 2px dashed black;
  margin-top: 240px;
  left:-30px;
}

.wrapper .container ul li:last-child:before{
  border-left:none;
}

.wrapper .container ul li:not(:first-child) {
  margin-top:200px;
}

.wrapper .container ul li > span {
  width: 2px;
  height: 100%;
  background: black;
  left: -30px;
  top: 0;
  position: absolute;
}

.wrapper .container ul li > span:before, .wrapper .container ul li > span:after {
  content: "";
  width: 8px;
  height: 8px;
  border-radius: 50%;
  border: 2px solid black;
  position: absolute;
  background: #d15641;
  left: -5px;
  top: 0;
}
.wrapper .container ul li span:after {
  top: 100%;
}

.wrapper .container ul li > div {
  margin-left: 10px;
}
.wrapper .container div .title, .wrapper .container div .type {
  font-weight: 600;
  font-size: 12px;
}
.wrapper .container div .info {
  font-weight: 300;
}
.wrapper .container div > div {
  margin-top: 5px;
}
.wrapper .container span.number {
  height: 100%;
}
.wrapper .container span.number span {
  position: absolute;
  font-size: 24px;
  left: -75px;
  font-weight: bold;
}
.wrapper .container span.number span:first-child {
  top: -15px;
}
.wrapper .container span.number span:last-child {
  bottom: -15px;
}

.iti_item {
  margin:20px 0px;
}


.iti_item p {
  padding-right:10%;
  font-size: calc((.9em + .1vmin) + (.7em + .1vmax));

}

.wrapper .container ul li .row .col-sm-4 {
  margin:20px 40x;
}

.wrapper .container ul li .row .col-sm-4 img {
  max-width:100%;
}

.sidebar {
  width: 160px;
  height: 100% ;
  position: sticky;
  float: left ;
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 90px ;
  padding-left: 20px ;
}

.sidebar a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #000 ;
}

.timeline_nav {
  -webkit-transition: top .3 ease-out;
  transition: top .3s ease-out;
}

.timeline_nav ul li {
  -webkit-transition: all .3s ease-out;
  transition: all .3s ease-out;
  cursor:pointer;
}

.timeline_nav ul li.active {
  font-weight: bold;
  color: #f94125;
  -webkit-transform: scale(1.2);
          transform: scale(1.2);
}

.timeline_nav ul li:hover {
  color: grey;
}
.timeline_nav ul li.active:hover {
  color: black;
}

.timeline_nav a {
  color: inherit;
}



@media (max-width:1183px){
  .wrapper {
    margin-left:2%;
  }
}

@media (max-width:1030px){
.milestone {
  margin-left:8%;
}

  .wrapper {
    left:0%;
  }
  .wrapper .container ul li {
    width:833px;
  }
}

@media (max-width:786px){
.milestone {
  margin-left:8%;
}

.wrapper {
  width:80%;
  margin-right: 10px ;
}

.wrapper .container ul li {
  width:627px;
}

.sidebar {
  width: 30% ;
  padding-left: 0px ;
}

}

@media (max-width:576px){
  .iti_item{
    padding-top:10px;
  }
  .title{
    margin-left:37px;
    width:90%;
  }
  .wrapper{
    margin-left:90px;
    width:88%;
  }

  .wrapper .container ul li {
    width:300px;
    height:auto;
  }

  .sidebar ul {
    width: 30% ;
  } 

  .milestone {
    left:30%;
  }     

  section{
    width:108%;
  }
  footer{
    width:111%;
  }
  #navigation{
    width:111%;
  }
}


</style>
</head>
<body>
    <!-- Navigation -->
    <div id='navigation'>
        <?php include('header.php') ?>
    </div> 
    
    <!-- Title -->
    <div class="container-fluid h1 text-center mt-5 p-0 title"><?php echo $iti_name?></div>

    <article class="timeline" id="timeline">
    </article>

<script text="text/javascript">


  var date_str = "" ;
  var date_nav = document.getElementById("timeline_nav") ;

  var unique_dates = <?php echo json_encode($UniqueDates) ?> ;
  var compile = <?php echo json_encode($compile) ?> ;

  // for date of each dates 

  if (compile.length == 0) {

    document.getElementById('timeline').innerHTML = '<p class="text-center h4 p-3" style="margin-bottom:280px; margin-top:150px;">You have yet to add any attractions!</p>'
    document.getElementById('timeline').setAttribute('style','margin: auto')

  }
  else {

    var timeline_str = `
          <nav class="timeline_nav sidebar">
            <ul>` ;

    var timeline_section = "" ;

    var section_wrapper = `<section class="timeline_section"><div class="wrapper">`;

    for (var i = 0 ; i< compile.length ; i++ ) {
      var date = unique_dates[i] ;

      // timeline located at side of website
      timeline_str += `<li><a href="#${date}"><span>${changeFormat2(date)}</span></a></li>`;

      // start of each new date
      timeline_section += `<a id="${date}"><h2 class="milestone"><span class="bg bg-dark py-2 px-5">${changeFormat2(date)}</span></h2></a><div class="container"><ul id="compile${i}">` ;

      var individual_date_attractions = compile[i] ;

      for ( var attraction of individual_date_attractions ) {

        var itinerary_id = attraction['itinerary_id'] ; 
        var uuid = attraction['uuid'] ;
        var attraction_name = attraction['attraction_name'] ;
        var start_time = attraction['START_TIME'] ;
        var start_time = start_time.slice(0,5) ;
        var end_time = attraction['END_TIME'] ;
        var end_time = end_time.slice(0,5) ;
        var category = attraction['attraction_category'] ;

        var tag1 = date ;
        var tag2 = uuid + start_time ;

        var combine = tag1 + tag2 ;
    
        timeline_section += `<li id=${combine}>` ;

        details_display(category, uuid,'itinerary_view', date, start_time, end_time, itinerary_id) ;

      }

      timeline_section += `</ul></div>`;
    }

    timeline_str += `</ul></nav>` ;

    var final = timeline_str + section_wrapper + timeline_section ;

    final += `</div></section>` ;

    document.getElementById('timeline').innerHTML = final ;
    date_nav.innerHTML += date_str ;

  }



</script>

<!----------- Footer ------------>
<footer class="footer-bs" id="footer">
    <?php include("footer.php") ?>  
</footer>
    
    <!-- Footer -->

    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
      var success = `<?php echo $success?>`;


      if(success != "" ) {
          swal("Good News!",success ,"success");
      }
    </script>


</body>
</html>
