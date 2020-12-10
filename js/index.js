// variable 
var apikey = 'kxER3J5kxBlY9nr3RKNoADMB4DpGXpdZ';
var apikey_open = '965de2f7d2a5ed0b95c687ebf28ba869'

var user_categories = {
    "accommodation" : "Accommodation",
    "event" : "Events",
    "bars_clubs" : "Bars & Clubs",
    "attractions" : "Attractions",
    "tour" : "Tours",
    "shops" : "Shopping", 
    "food_beverages" : "Food & Drinks", 
    "walking_trail" : "Walking Trails",
};

var inverse_user_categories = {
    "Accommodation" : "accommodation",
    "Events": "event",
    "Bars & Clubs" : "bars-clubs",
    "Attractions" : "attractions",
    "Tours" : "tour",
    "Shopping" : "shops" , 
    "Food & Beverages" : "food-beverages", 
    "Walking Trails" : "walking-trail",
}


// ============================================================================================================================================================
// Function to display Trending card carousel and Nearby (if users allow)
// Will display recommendation as well if user logs in 
function display_default() {

    
    /* 
    var login_check is boolean var where its used to check if session variable email is created in index.php
    */ 

    // Display trending attractions (attractions with 5.5km from Marina Bay MRT)
    enhancednav_api(1.2764, 103.8546, 5500, 'trending');

    // Ask user for permission to get their location 
    // Will call API top 5 attractions within 5.5km radius of their current location if users allow their location to be shared

    if('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition((position) => {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;

            document.getElementById('nearby_heading').innerHTML = `
            <h1 class="carousel_title2" id='nearby_heading'><span>Attractions Near You</span></h1> 
            <hr style="margin-top:20px; height:3px;border-width:0; width: 150px; background-color:#116466;">
            `;

            enhancednav_api(lat, long, 5500, 'nearby');

        });
    }

    // Check if user have logged in
    // Will call API to display top 5 attractions of their indicated preference
    if (login_check) {

        // call content user API to display top 5 attractions based on their indicated preference
        recommendations(categories);

    }

    // Display weather
    display_weather();

}

// ============================================================================================================================================================
// Function to call Enhanced Navigation API for Trending and Nearby
function enhancednav_api(lat, long, radius, id) {

    // Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            // convert response into json and get stars record
            var response_json = JSON.parse(this.responseText);
            var attraction_array = response_json.data;

            // console.log(`-----------------${id}-------------`);
            // console.log(attraction_array);

            card_carousel(attraction_array, id);            

        }

    }

    // Step 3
    // Specify method: GET for retrieval
    var url = `https://tih-api.stb.gov.sg/map/v1/search/multidataset?location=${lat}%2C%20${long}&radius=${radius}&dataset=accommodation%2C%20attractions%2C%20bars_clubs%2C%20food_beverages%2C%20walking_trail&sort=rating&apikey=${apikey}`;

    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();
}

// ============================================================================================================================================================
// Function to extract information from API output and convert into card carousel and insert into index.php through ID of div
// Likely to only work with enhanced nav API because of the data structure of the API output
function card_carousel(attraction_array, id) {

    // Counter to count how many attractions have been added. Stop adding once it hits 5
    var counter = 0;
    var card_slider = ``;

    // only show top 5 attractions 
    for (attraction of attraction_array) {   

        var img_details = attraction.images;

        // console.log(attraction.name);
        // console.log(img_details);

        if (img_details.length != 0) {

            // check if uuid exists in images, else check url, then check if value has something, else skip
            var img_uuid = attraction.images[0].uuid;
            // console.log(img_uuid);

            var src_img = `https://tih-api.stb.gov.sg/media/v1/download/uuid/${img_uuid}?apikey=${apikey}`;

            // console.log(src_img);

   

            if (img_uuid === "") {
                src_img = attraction.images[0].url;

            }             

            // Retrieve all the information of attraction (name, picture, ratings, category, uuid)
            var attraction_name = attraction.name;
            var rating = attraction.rating;
            var category = attraction.categoryDescription;
            var uuid = attraction.uuid;

            // console.log(attraction_name);
            // console.log(uuid);

            // console.log(i);
            // console.log(attraction_name);
            // console.log(category);

            // Setting up of stars
            var stars = create_stars(rating);

            // Adding HTML codes into card_slider 
            card_slider += `
            <div class='card'>
                <div class='img'>
                    <img class='card_image' src='${src_img}' onerror='replace_image(this)'>
                </div>

                <div class='card-body d-flex flex-column p-0 pt-2'>
                    <div class='attraction_title'>${attraction_name}</div>
                    <p>
                        <span class='badge badge-secondary'>${category}</span> 
                    </p>

                    <div class='card-text mt-auto'>
                            Rating: ${rating} / 5

                            <br>
                            ${stars}
                            <br>
                            <button type="button" class="btn btn-info mt-auto" onclick="location.href='details.php?category=${inverse_user_categories[category]}&uuid=${uuid}'">More Info</button>
                    </div>

                </div>
            </div>`;

            counter += 1;
        

            // Stop for loop once retrieved 5 attractions
            if (counter == 5) {
                break;
            }

        }

        
    }

    // Push cards into index.html

    document.getElementById(id).innerHTML = card_slider;

    // Set up owl carousel for particular div
    jQuery(document).ready(function() {
        jQuery('#' + id).owlCarousel({
            loop:true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
    
            navText : ["<i class='fa fa-chevron-left' style='color: #6ebfc2'></i>","<i class='fa fa-chevron-right' style='color: #6ebfc2'></i>"],
        
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    navText : ["<i class='fa fa-chevron-left' style='color: #6ebfc2'></i>","<i class='fa fa-chevron-right' style='color: #6ebfc2'></i>"]
                },
                576:{
                    items:2,
                    nav:true,
                    navText : ["<i class='fa fa-chevron-left' style='color: #6ebfc2'></i>","<i class='fa fa-chevron-right' style='color: #6ebfc2'></i>"]
                },
                992:{
                    items:3,
                    nav:true,
                    navText : ["<i class='fa fa-chevron-left' style='color: #6ebfc2'></i>","<i class='fa fa-chevron-right' style='color: #6ebfc2'></i>"]
                },
            }
        });

    });


}

// ============================================================================================================================================================
// Function to create stars for ratings 
function create_stars(rating) {
    
    var stars = '';
    for (j=1; j<6; j++) {

        if (j <= Math.floor(rating)) {
            stars += `<span class="fa fa-star checked"></span>`;
        }
        else {
            stars += `<span class="fa fa-star"></span>`;
        }

    }

    return stars;
}

// ============================================================================================================================================================
// Function to replace API image if link is broken
function replace_image(image) {
    image.src = "images/no_image.png";
}


// ============================================================================================================================================================
// Function to retrieve users indicated preference after they login and create necessary elements to append card carousel for indicated category 
// Subsequently loop through each category and call recommendation API separately to populate each category 
function recommendations(categories) {

    // console.log(categories);

    var user_preference = categories.split(',');
    // console.log(user_preference);

    var recommendations = document.getElementById('recommendations');


    for (category of user_preference) {
        // console.log(categories);

        // Create div element to contain heading and card carousel
        var container = document.createElement('div');
        container.setAttribute('class','container p-0');
        container.setAttribute('style','margin: 50px 0px 50px 0px;');

        // Create span element for heading and add heading into it
        var span = document.createElement('span');
        span.setAttribute('id','category_heading');
        span.setAttribute('style','font-size:60px');
        span.innerHTML = `<h1 class="carousel_title"><span>${user_categories[category]}</span></h1>`;
        
        // Add heading into container
        container.appendChild(span);

        // Create div element to contain the card carousels
        var owl_carousel = document.createElement('div');
        owl_carousel.setAttribute('class','slider owl-carousel');
        owl_carousel.setAttribute('style','margin:auto; margin-top: 50px;');
        owl_carousel.setAttribute('id', category);

        // Add owl_carousel into container
        container.appendChild(owl_carousel);

        // console.log(container);
        recommendations.appendChild(container);

        // --------------------------------------------------------------------------------------------------
        recommendation_api(category);

    }
        
}


// ============================================================================================================================================================
// Function to call Multidata set API and retrieve attractions within category
function recommendation_api(category) {

        // Calling the API to retrieve top 5 from each categories 
        // Step 1 - Create a new Request
        var request = new XMLHttpRequest(); // Prep to make an HTTP request

        // Step 2 - Register a function with the Request
        request.onreadystatechange = function() {

            if( this.readyState == 4 && this.status == 200 ) {

                // convert response into json and get stars record
                var response_json = JSON.parse(this.responseText);
                var attraction_array = response_json.data.results;

                // console.log(category);
                // console.log(attraction_array);
                card_carousel(attraction_array, category);                

            }
        }

        // Step 3
        // Specify method: GET for retrieval

        var url = `https://tih-api.stb.gov.sg/content/v1/search/all?dataset=${category}&sortBy=rating&sortOrder=DESC&language=en&apikey=${apikey}`;

        request.open("GET", url, true);

        // console.log(url);

        // Step 4
        // calling the api
        request.send();   

}

// ============================================================================================================================================================
// Function to call content user API using UUID to get information and display on details.php page
function details_display(category, uuid, page, date, start, end, itinerary_id) {

    // Calling the API to retrieve attraction information

    // Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            // convert response into json and get stars record
            var response_json = JSON.parse(this.responseText);
            var attraction_info = response_json.data[0];

            // console.log(attraction_info);

            // Retrieving image for attraction
            var img_uuid = attraction_info.images[0].uuid;
            var src_img = `https://tih-api.stb.gov.sg/media/v1/download/uuid/${img_uuid}?apikey=kxER3J5kxBlY9nr3RKNoADMB4DpGXpdZ`;

            if (img_uuid == "") {
                src_img = attraction_info.images[0].url;
            }

            
            var attraction_name = attraction_info.name;
            var attraction_description = attraction_info.description;
            var attraction_category = attraction_info.categoryDescription;

            // Add address
            var address_array = attraction_info.address; // Return address in array (block, buildingName, floorNumber, postalCode, streetName, unitNumber)
            var address = '-';
            if (address_array !== undefined) {
                address = `${address_array.streetName}, Singapore ${address_array.postalCode}`
            }

            // Add contact
            var phone_number_array = attraction_info.contact; // Return contact (primaryContactNo, secondaryContactNo)
            var phone_number = phone_number_array['primaryContactNo'];
            if (phone_number == '') {
                phone_number = phone_number_array['secondaryContactNo'];
            }

            var email = attraction_info.officialEmail;
            var website = attraction_info.officialWebsite;
            
            var rating = attraction_info.rating;
            var stars = create_stars(rating);

            // console.log(attraction_info);

            if (page === 'details') {

                //Add image
                document.getElementById('attraction_image').setAttribute("src", src_img);

                // Add Attraction Name
                document.getElementById('attraction_name').innerText = attraction_name;
                document.getElementById('attraction_name_value').setAttribute('value', attraction_name);

                // Add description
                document.getElementById('description').innerText = attraction_description;

                // Add category
                document.getElementById('category').innerText = attraction_category;


                
                // console.log(address);
                document.getElementById('address').innerText = address;

                // Add contact
                document.getElementById('contact').innerHTML = "Phone number: " + phone_number + "<br>" + "Email: " + email;

                // Add website
                document.getElementById('website').innerHTML = `<a href='${website}' target="_blank">Click here!</a>`;

                // Setting up of rating stars

                document.getElementById('ratings').innerHTML = `<i>Rating: ${stars}</i>`;


                // console.log(typeof attraction_info.reviews);

                // check if there is any review in the response from API. Append if there is. Else move on.
                if (typeof attraction_info.reviews !== 'undefined') {

                    // Return the array of reviews for attraction (authorName, authorURL, language, profilePhoto, rating, text)
                    var review_array = attraction_info.reviews; 

                    for (review of review_array) {

                        // console.log(review);        
        
                        // Container for one review
                        var container_node = document.createElement('div');
                        container_node.setAttribute('class','container-fluid');
                        container_node.setAttribute('style','margin: 10px; border: solid #EAEAEA 1px; border-radius:10px');
        
                        // Row with 2 cols. First col contains the profile picture. The second col contains name, ratings and text
                        var row_node = document.createElement('div');
                        row_node.setAttribute('class','row my-auto p-2');
                        
                        // Col for profile picture
                        var dp_col_node = document.createElement('div');
                        dp_col_node.setAttribute('class','col-md-2 d-flex justify-content-center m-auto');
                        dp_col_node.setAttribute('style','width:90%; height: 90%;');
                        dp_col_node.innerHTML = `<img src='${review.profilePhoto}'>`;
        
                        // Col for name, rating and text
                        var review_rating = create_stars(review.rating)
                        var content_col_node = document.createElement('div');
                        content_col_node.setAttribute('class','col-sm-10');
                        content_col_node.innerHTML = `<h3>${review.authorName}</h3>
                                                        <i>Rating: ${review_rating}</i>
                                                        <br>
                                                        
                                                        <p>${review.text}</p>`;
        
                        // Append col divs into row div
                        row_node.appendChild(dp_col_node);
                        row_node.appendChild(content_col_node);
                        // console.log(row_node);
        
                        // Append row into container
                        container_node.appendChild(row_node);
        
                        //Append container to details.php
                        var reviews_container = document.getElementById('reviews');
                        reviews_container.innerHTML = '';
                        reviews_container.appendChild(container_node);
        
        
                        // console.log(container_node);
        
                    }

                }
                
                
                // Return lat and long of attraction to call enhanced navi api to display recommendation
                var latlong = attraction_info.location; 
                var lat = latlong.latitude;
                var long = latlong.longitude;


                enhancednav_api(lat, long, 3000, 'recommendation');
                document.getElementById('recommendation_title').innerText = `More Attractions in the Area`;

                // console.log(response_json);

            }

            else {

                var attraction_details = "" ;
                attraction_details = `
                <span></span>
                <div class='row'>
                    <div class='col-sm-4'>
                      <img src=${src_img}>
                    </div>

                    <div class="col iti_item"> 
                      <!-- Name -->
                      <h1 class='h2 mt-0'>${attraction_name}</h1>
                      <!-- Ratings -->
                      <div style='padding-left: 15px;' id='ratings'>${stars}
                      </div>
                      <!-- Address -->
                      <p style="font-size:calc(17px + (26 - 14) * ((90vw - 300px) / (1600 - 300)))">
                        <span class="fa fa-map-marker"></span> 
                        <b style="padding-left: 12px;">Address:</b> 
                        <p id='address'>${address}</p>
                      </p>
                      <!-- Description -->
                      <p id='description'>${attraction_description}</p>

                      <button type="button" class="mt-2 btn btn-danger" onclick="location.href= 'process_delete_attraction.php?itinerary_id=${itinerary_id}&start_time=${start}&date=${date}'" >
                        Remove Attraction
                      </button>
                    </div> 
                  </div>
                  <span class="number"><span>${start}</span><span>${end}</span></span>
                </li>` ;

                var tag1 = date ;
                var tag2 = uuid + start ;

                var combine = tag1 + tag2 ;

                document.getElementById(combine).innerHTML += attraction_details ;

            }

        }
    }

    // Step 3
    // Specify method: GET for retrieval

    var url = `https://tih-api.stb.gov.sg/content/v1/${category.replace('_','-')}?uuid=${uuid}&apikey=${apikey}`;
    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();   
}

// ============================================================================================================================================================
// Function to call Multidata set API and display all attractions within category in index page
// Attractions will be sorted by ratings in ascending order
function category_display(category) {

    // Calling the API to retrieve attraction information

    // Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            // convert response into json and get stars record
            var response_json = JSON.parse(this.responseText);
            var attraction_array = response_json.data.results;

            // console.log(attraction_array);

            var card_deck = `
            <div class='container' style='margin: auto; margin-top:30px; width: 80%;'>

                <!-- Row for heading -->
                <div class='row'>   
                    <div class='col'>
                        <h1 class="carousel_title"><span>${user_categories[category]}</span></h1>
                    </div>
                </div>

                <!-- Row for content -->
                <div class='row justify-content-center' style='margin: auto'>`;

            for (attraction of attraction_array) {

                // Check if image exists for attraction. Skip attraction if no image exist.
                var image_array = attraction.images;

                if (image_array.length != 0) {
                    // console.log(card_deck);
                    card_deck += attraction_cards(attraction, category);
                    
                }
            }
            
            // Add closing tags to card deck
            card_deck += `
                </div>
            </div>`;

            // Add card deck to index page and replace all content body
            document.getElementById('content_body').innerHTML = card_deck;
            

        }
    }

    // Step 3
    // Specify method: GET for retrieval

    var url = `https://tih-api.stb.gov.sg/content/v1/search/all?dataset=${category}&sortBy=rating&sortOrder=DESC&language=en&apikey=${apikey}`;
    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();   

}


// ============================================================================================================================================================
// Function to create cards for individual attractions (used for search and categories)
function attraction_cards (attraction, category) {

        // Retrieve image uuid. If image uuid does not exist, use url
        var img_uuid = attraction.images[0].uuid;

        // console.log(img_uuid);
        var src_img = `https://tih-api.stb.gov.sg/media/v1/download/uuid/${img_uuid}?apikey=${apikey}`;

        if (img_uuid == "") {
            src_img = attraction.images[0].url;
        }


        var attraction_name = attraction.name;
        var attraction_tags_array = attraction.tags;
        var ratings = create_stars(attraction.rating);
        var uuid = attraction.uuid;

        var card_deck = `<div class='card col-md-3 col-sm-6 col-12 p-4 m-3' >

                        <div class='img'>
                            <img class="card_image" src="${src_img}" style='height 400px; width: 100%' onerror='replace_image(this)'>
                        </div>

                        <div class="card-body d-flex flex-column p-0">

                            <h5 class="card-title">${attraction_name}</h5>

                            <p class="card-text" style='text-align:bottom'>
                                Ratings:${ratings}
                                <br>
                            `;


        // Counter to only display up to 5 tags of attraction 
        if (attraction_tags_array.length > 5) {
            var tag_counter = 5;
        }
        else {
            var tag_counter = attraction_tags_array.length;
        }

        // Add attraction badges to card
        for (i=0; i < tag_counter; i++) {

            card_deck += `<span class='badge badge-secondary'>${attraction_tags_array[i]}</span> `;

        }

        card_deck += `      </p>
                            <button type="button" class="btn btn-info mt-auto" onclick="location.href='details.php?category=${category}&uuid=${uuid}'">More Info</button>
                        </div>
                    </div>
                    `;

        return card_deck;

}

// ============================================================================================================================================================
// Function to call Multidata set API and display user search result
function search_keyword(keyword) {


    // Remove current content in content body
    
    document.getElementById('content_body'). innerHTML = '';

    // Create relevant nodes for search results
    // Container node for the cards
    var container_node = document.createElement('div');
    container_node.setAttribute('class','container');
    container_node.setAttribute('style','margin: auto; margin-top:30px; width: 80%;');

    // Row node for heading 
    var heading_row = document.createElement('div');
    heading_row.setAttribute('class','row m-3');

    // Heading node
    var heading_node = document.createElement('h1');
    var span_node = document.createElement('span');
    heading_node.setAttribute('class','carousel_title')
    span_node.innerText = 'Search results for <' + keyword + '>';
    heading_node.appendChild(span_node);

    heading_row.appendChild(heading_node);

    // Row node for cards
    var card_nodes = document.createElement('div');
    card_nodes.setAttribute('class','row justify-content-center');
    card_nodes.setAttribute('style','margin: auto; margin-bottom: 10px');
    card_nodes.setAttribute('id','search_results');
    

    container_node.appendChild(heading_row);
    container_node.appendChild(card_nodes);
    
    document.getElementById('content_body').appendChild(container_node);

    document.getElementById('search_results').innerHTML = '<h3> Oops no search results :( </h3>';


    // Concatenate all categories into string
    api_dataset = 'accommodation%2C%20attractions%2C%20bars_clubs%2C%20event%2C%20food_beverages%2C%20shops%2C%20tour%2C%20walking_trail%2C%20precincts';

    search_api(api_dataset, keyword);

}


// ============================================================================================================================================================
// Function to call Multidata set API and display user search result
function search_api(category, keyword) {

    // Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            // convert response into json and get stars record
            var response_json = JSON.parse(this.responseText);
            var attraction_array = response_json.data.results;

            // console.log(attraction_array);
            
            document.getElementById('search_results').innerHTML = '';

            // Display max of 5 attractions from each category

            for (attraction of attraction_array) {

                // Check if any images exists for attraction, else skip
                var images_array = attraction.images;

                if (images_array.length != 0) {

                    var attraction_name = attraction.name;
                    var attraction_tags_array = attraction.tags;
                    var ratings = create_stars(attraction.rating);
                    var uuid = attraction.uuid;
                    var attraction_category = attraction.dataset;

                    // Retrieve image uuid. If image uuid does not exist, use url
                    var img_uuid = attraction.images[0].uuid;

                    // console.log(img_uuid);
                    var src_img = `https://tih-api.stb.gov.sg/media/v1/download/uuid/${img_uuid}?apikey=${apikey}`;

                    if (img_uuid == "") {
                        src_img = attraction.images[0].url;
                    }           

                    // Node for card
                    var card_deck_node = document.createElement('div');
                    card_deck_node.setAttribute('class','card col-md-3 col-sm-6 col-12 p-4 m-3');

                    // Node for image 
                    var card_image = document.createElement('div');
                    card_image.setAttribute('class','img');
                    var image = document.createElement('img');
                    image.setAttribute('src',src_img);
                    image.setAttribute('style','height: 200px; width: 100%');
                    image.setAttribute('onerror', `replace_image(this)`);

                    card_image.appendChild(image);

                    // Node for card body
                    var card_body = document.createElement('div');
                    card_body.setAttribute('class','card-body d-flex flex-column p-0');

                    // Node for card title 
                    var card_title = document.createElement('h5');
                    card_title.setAttribute('class','card-title');
                    card_title.innerText = attraction_name;

                    // Node for ratings and tags
                    var card_text = document.createElement('p');
                    card_text.setAttribute('class','card-text');
                    card_text.setAttribute('style','text-align:bottom');

                    // Limiting the tags to max 5
                    if (attraction_tags_array.length > 5) {
                        var tag_counter = 5;
                    }
                    else {
                        var tag_counter = attraction_tags_array.length;
                    }

                    var tags = '';
                    for (i=0; i < tag_counter; i++) {

                        tags += `<span class='badge badge-secondary'>${attraction_tags_array[i]}</span> `;

                    }

                    card_text.innerHTML = 'Ratings: ' + ratings + '<br>' + tags;

                    // Node for button 
                    var button = document.createElement('button');
                    button.setAttribute('type','button');
                    button.setAttribute('class','btn btn-info mt-auto');
                    button.setAttribute('onclick',`location.href='details.php?category=${attraction_category}&uuid=${uuid}'`);
                    button.innerText = 'More Info';


                    card_body.appendChild(card_title);
                    card_body.appendChild(card_text);
                    card_body.appendChild(button);

                    card_deck_node.appendChild(card_image);
                    card_deck_node.appendChild(card_body);

      
                    // console.log(card_deck);

                    document.getElementById('search_results').appendChild(card_deck_node);   

                }

            }
        }
        else {
            console.log('fail');
        }
    }
    
    // Step 3
    // Specify method: GET for retrieval

    var url = `https://tih-api.stb.gov.sg/content/v1/search/all?dataset=${category}&keyword=${keyword}&sortBy=rating&language=en&apikey=${apikey}`;
    request.open("GET", url, false);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();  

}

// ============================================================================================================================================================
// Search bar 
'use strict';

    var searchBox = document.querySelectorAll('.search-box input[type="text"] + span');
    
    searchBox.forEach(elm => {
      elm.addEventListener('click', () => {
        elm.previousElementSibling.value = '';
      });
    });



// Weather 

function display_weather(){
    today_weather_api_tih();
    today_weather_api_open();
    four_day_weather_api_tih();
    seven_day_weather_api_open();
  }
  
//Function to call 24h API for description (TIH)
function today_weather_api_tih(){

// Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            var response_json = JSON.parse(this.responseText);
            var weather_array = response_json.data;
            var current_day = weather_array[0];
            var date = current_day.startTime;
            var day = getDay(date);
            var pos = date.indexOf("T");
            date = date.slice(0, pos)
            date = changeFormat(date);
            var current_day_desc = current_day.regions.central; 
            var icon = getWeatherIcon(current_day_desc);
            document.getElementById("today_icon").innerHTML = icon;
            document.getElementById("today_date_day").innerHTML = date[0];
            document.getElementById("today_date_month").innerHTML = date[1];
            document.getElementById("today_desc").innerHTML = current_day_desc;
            document.getElementById("today_day").innerHTML = day;
        }
        //End of if ready state
    }
    //End of onreadystate

    // Step 3
    // Specify method: GET for retrieval
    var url = `https://tih-api.stb.gov.sg/weather/v1/24hr-forecast?apikey=${apikey}`;

    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();
}

//Function to call current weather API for details (OpenWeather)
function today_weather_api_open(){

// Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            var response_json = JSON.parse(this.responseText);
            var temp_min = response_json.main.temp_min;
            var temp_max = response_json.main.temp_max;
            var humidity = response_json.main.humidity;
            var wind_speed = response_json.wind.speed;
            wind_speed = (wind_speed * 3.6).toFixed();
            temp_max = temp_max.toFixed();
            temp_min = temp_min.toFixed();

            document.getElementById("today_temp").innerHTML = `${temp_min} - ${temp_max}°C 
            `;
            document.getElementById("today_details").innerHTML = `<span><i class='fas fa-wind'></i> ${wind_speed} km/h</span> <span><i class='fas fa-water'></i> ${humidity}%</span>
            `;

        } 
        //End of if ready state
    }
    //End of onreadystate

    // Step 3
    // Specify method: GET for retrieval
    var url = `http://api.openweathermap.org/data/2.5/weather?lat=1.287953&lon=103.851784&appid=${apikey_open}&units=metric`;

    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();
}

//Function to call weatherBy4day API for weather forecast (TIH) 
function four_day_weather_api_tih(){

// Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            var response_json = JSON.parse(this.responseText);
            var weather_array = response_json.data;

            for (var i = 0; i<weather_array.length; i++){
            var per_day = weather_array[i];
            var date = per_day.date;
            var forecast = per_day.forecast;
            var temp_min = per_day.temperature.low;
            var temp_max = per_day.temperature.high;
            var day = getDay(date);
            var icon = getWeatherIcon(forecast);
            date = changeFormat(date);


            if (i==0){
                document.getElementById("second_day").innerHTML = day;
                document.getElementById("second_icon").innerHTML = icon;
                document.getElementById("second_date_day").innerHTML = date[0];
                document.getElementById("second_date_month").innerHTML = date[1];                
                document.getElementById("second_desc").innerHTML = forecast;
                document.getElementById("second_temp").innerHTML = `${temp_min} - ${temp_max}°C`;
            }

            if (i==1){
                document.getElementById("third_day").innerHTML = day;
                document.getElementById("third_icon").innerHTML = icon;
                document.getElementById("third_date_day").innerHTML = date[0];
                document.getElementById("third_date_month").innerHTML = date[1]; 
                document.getElementById("third_desc").innerHTML = forecast;
                document.getElementById("third_temp").innerHTML = `${temp_min} - ${temp_max}°C`;
            }

            if (i==2){
                document.getElementById("fourth_day").innerHTML = day;
                document.getElementById("fourth_icon").innerHTML = icon;
                document.getElementById("fourth_date_day").innerHTML = date[0];
                document.getElementById("fourth_date_month").innerHTML = date[1]; 
                document.getElementById("fourth_desc").innerHTML = forecast;
                document.getElementById("fourth_temp").innerHTML = `${temp_min} - ${temp_max}°C`;
            }

            if (i==3){
                document.getElementById("fifth_day").innerHTML = day;
                document.getElementById("fifth_icon").innerHTML = icon;
                document.getElementById("fifth_date_day").innerHTML = date[0];
                document.getElementById("fifth_date_month").innerHTML = date[1];             
                document.getElementById("fifth_desc").innerHTML = forecast;
                document.getElementById("fifth_temp").innerHTML = `${temp_min} - ${temp_max}°C`;
            }
            }
        //End of for loop 
        }
        //End of if ready state
    }
    //End of onreadystate

    // Step 3
    // Specify method: GET for retrieval
    var url = `https://tih-api.stb.gov.sg/weather/v1/4day-forecast?apikey=${apikey}`;

    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();
}


//Function to call 7day API for weather forecast (OpenWeather) 
function seven_day_weather_api_open(){

// Step 1 - Create a new Request
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    // Step 2 - Register a function with the Request
    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {

            var response_json = JSON.parse(this.responseText);
            var weather_array = response_json.daily;
            
            for (var i = 0; i<weather_array.length; i++){
            var per_day = weather_array[i];
            /*
            var date = per_day.dt;
            date = new Date(1000*date);
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            date = day + "-" +(month + 1) + "-" + year;
            day = getDay(date);
            */
            var wind = per_day.wind_speed;
            var humidity = per_day.humidity;
            wind = (wind * 3.6).toFixed();


            if (i==1){
                document.getElementById("second_details").innerHTML = `<span><i class='fas fa-wind'></i> ${wind} km/h</span> <span><i class='fas fa-water'></i> ${humidity}%</span>`;            
            }

            if (i==2){
                document.getElementById("third_details").innerHTML = `<span><i class='fas fa-wind'></i> ${wind} km/h</span> <span><i class='fas fa-water'></i> ${humidity}%</span>`;
            }

            if (i==3){
                document.getElementById("fourth_details").innerHTML = `<span><i class='fas fa-wind'></i> ${wind} km/h</span> <span><i class='fas fa-water'></i> ${humidity}%</span>`;
            }

            if (i==4){
                document.getElementById("fifth_details").innerHTML = `<span><i class='fas fa-wind'></i> ${wind} km/h</span> <span><i class='fas fa-water'></i> ${humidity}%</span>`;
            }
            }
        //End of for loop 
        }
        //End of if ready state
    }
    //End of onreadystate

    // Step 3
    // Specify method: GET for retrieval
    var url = `https://api.openweathermap.org/data/2.5/onecall?lat=1.287953&lon=103.851784&exclude=minutely,hourly,alerts,current&appid=${apikey_open}&units=metric`;

    request.open("GET", url, true);

    // console.log(url);

    // Step 4
    // calling the api
    request.send();
}


function getDay(date){
var d = new Date(date);
d = d.getDay();
var weekday = new Array(7);
    weekday[0] = "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";
d = weekday[d];
return d;
}


function changeFormat(date){
    var components = date.split('-');
    var month = components[1];
    var day = components[2];
    if (month=='01'){
        month = 'January';
    }
    if (month=='02'){
        month = 'February';
    }
    if (month=='03'){
        month = 'March';
    }
    if (month=='04'){
        month = 'April';
    }
    if (month=='05'){
        month = 'May';
    }
    if (month=='06'){
        month = 'June';
    }
    if (month=='07'){
        month = 'July';
    }
    if (month=='08'){
        month = 'August';
    }
    if (month=='09'){
        month = 'September';
    }
    if (month=='10'){
        month = 'October';
    }
    if (month=='11'){
        month = 'November';
    }
    if (month=='12'){
        month = 'December';
    }

    return [day,month];
}

function changeFormat2(date){
    var components = date.split('-');
    var month = components[1];
    var day = components[2];
    if (month=='01'){
        month = 'Jan';
    }
    if (month=='02'){
        month = 'Feb';
    }
    if (month=='03'){
        month = 'Mar';
    }
    if (month=='04'){
        month = 'Apr';
    }
    if (month=='05'){
        month = 'May';
    }
    if (month=='06'){
        month = 'Jun';
    }
    if (month=='07'){
        month = 'Jul';
    }
    if (month=='08'){
        month = 'Aug';
    }
    if (month=='09'){
        month = 'Sep';
    }
    if (month=='10'){
        month = 'Oct';
    }
    if (month=='11'){
        month = 'Nov';
    }
    if (month=='12'){
        month = 'Dec';
    }

    return [day + ' ' + month];
}
/*
function getShort(day){
if (day == "Monday"){
    return "MON";
}
if (day == "Tuesday"){
    return "TUES";
}
if (day == "Wedneday"){
    return "WED";
}
if (day == "Thursday"){
    return "THUR";
}
if (day == "Friday"){
    return "FRI";
}
if (day == "Saturday"){
    return "SAT";
}

else {
    return "SUN";
}
}
*/

function getWeatherIcon(forecast){
if (forecast.includes("thundery") || forecast.includes("Thunder") || forecast.includes("rain") || forecast.includes("Rain")){
    return `<div class="svg-contain">
            <svg class="hurricane-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-437 254.4 85 52.6" style="enable-background:new -437 254.4 85 52.6;" xml:space="preserve">
                <path class="cloud" d="M-361.9,280.5c1.4,0,2.6,0.7,3.4,1.7h1.1c0.4-8.2-5.9-10.8-5.9-10.8c-2.2-1.5-5.4-1-5.4-1
                    c-0.1-4.1-2.9-7.4-2.9-7.4c-4.7-5.5-10.3-4.9-10.3-4.9c-7.4-0.2-11,5.9-11,5.9c-5.6-4-14.3-2.6-18.2,3.1c-0.7,1.1-1.3,2.2-1.8,3.4
                    c0,0.1-0.3,1.2-0.4,1.2c3.5-0.6,6.6,1.6,6.6,1.6s1.1-1.1,1.2-1.3c2.4-2.4,5.6-3.6,9-3.2c4.4,0.5,8.5,3,9.9,7.4
                    c0.1,0.2,0.8,2.4,0.6,2.4c5.3,0.1,7.3,3.6,7.3,3.6h13.4C-364.5,281.2-363.3,280.5-361.9,280.5z"/>
                <path class="cloud" d="M-386,279.6c-0.2,0-0.4,0-0.6,0.1c-0.1-0.8-0.2-1.7-0.4-2.4c-0.3-1-0.8-2-1.4-2.9c-2-2.9-5.3-4.8-9-4.8
                    c-2.3,0-4.4,0.7-6.1,1.9c-0.6,0.4-1.1,0.8-1.6,1.3c-0.2,0.2-0.5,0.5-0.7,0.8c-0.2,0.3-0.4,0.5-0.6,0.8c-1.8-1.2-3.9-1.9-6.2-1.9
                    c-5.5,0-10,4-10.8,9.3c-3.5,1-6.1,3.9-6.6,7.6h26.3h12.7h2.3l4.7-6.2c0.6-0.8,1.7-0.9,2.5-0.3s0.9,1.7,0.3,2.5l-3.1,4h0.5h5.6h0.7
                    c0.1,0,0.2-0.4,0.2-1.1C-377.4,283.5-381.3,279.6-386,279.6z"/>
                <polyline class="lightening" points="-382.8,284.2 -387.9,290.9 -380.6,291.2 -387.9,302 "/>
                <path class="line" d="M-426.9,294.4l-5.1,7.3"/>
                <path class="line" d="M-420.8,294.4l-5.1,7.3"/>
                <path class="line" d="M-415.4,294.4l-5.1,7.3"/>
                <path class="line" d="M-409.9,294.4l-5.1,7.3"/>
                <path class="line" d="M-404.5,294.4l-5.1,7.3"/>
                <path class="line" d="M-399.1,294.4l-5.1,7.3"/>
                <path class="line" d="M-393.7,294.4l-5.1,7.3"/>
                <path class="line" d="M-388.2,294.4l-5.1,7.3"/>
                <g>
                <path class="little-path path-1" d="M-374.8,287.2h10.6"/>
                <path class="little-path path-2" d="M-373.8,289.3h10.9"/>
                <path class="big-path" d="M-376,288.3c0,0,14,0,14,0c1.7,0,3.1-1.4,3.3-3.1c0-0.5,0-1-0.3-1.4c-0.9-2.3-4.1-2.7-5.6-0.7
                    c-0.4,0.6-0.7,1.3-0.7,1.9"/>
                <path class="little-path path-3" d="M-364.1,285c0-1.2,1-2.2,2.2-2.2s2.2,1,2.2,2.2c0,1.2-1,2.2-2.2,2.2"/>
            </g>
            </svg>
        </div>`;
}
else if (forecast.includes("cloudy") || forecast.includes("Cloudy") || forecast.includes("clouds") || forecast.includes("Clouds")){
    return `<div class="svg-contain">
            <svg class="overcast-clouds" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 82.6 52.3" style="enable-background:new 0 0 82.6 52.3;" xml:space="preserve">
            <g id="Layer_1">
                <path class="cloud-still" d="M21.8,24.2c0.1,0,0.3-1.1,0.4-1.2c0.5-1.2,1.1-2.4,1.8-3.4c3.9-5.7,12.6-7.1,18.2-3.1c0,0,3.7-6,11-5.9
                    c0,0,5.6-0.6,10.3,4.9c0,0,2.8,3.3,2.9,7.4c0,0,3.2-0.5,5.4,1c0,0,6.2,2.6,5.9,10.8H56.3c0,0-2-3.5-7.3-3.6c0.2,0-0.5-2.2-0.6-2.4
                    c-1.4-4.4-5.5-6.9-9.9-7.4c-3.4-0.4-6.6,0.8-9,3.2c-0.1,0.1-1.2,1.3-1.2,1.3S25.3,23.6,21.8,24.2z"/>
                <path class="cloud-still" d="M57.6,40.7c0-4.8-3.9-8.6-8.6-8.6c-0.2,0-0.4,0-0.6,0.1c-0.1-0.8-0.2-1.7-0.4-2.4c-0.3-1-0.8-2-1.4-2.9
                    c-2-2.9-5.3-4.8-9-4.8c-2.3,0-4.4,0.7-6.1,1.9c-0.6,0.4-1.1,0.8-1.6,1.3c-0.2,0.2-0.5,0.5-0.7,0.8c-0.2,0.3-0.4,0.5-0.6,0.8
                    c-1.8-1.2-3.9-1.9-6.2-1.9c-5.5,0-10,4-10.8,9.3c-3.5,1-6.1,3.9-6.6,7.6h26.3h12.7h12.9h0.7C57.6,41.8,57.6,41.4,57.6,40.7z"/>
            </g>
            <g id="Layer_2">
            </g>
            </svg></div>`;
}

else if (forecast.includes("windy") || forecast.includes("Windy")){
    return `<div class="svg-contain">
            <svg version="1.1" class="windy-svg" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-447 254.4 64 52.6" style="enable-background:new -447 254.4 64 52.6;" xml:space="preserve">
                <g id="Layer_1_1_">
                    <g>
                        <path class="st0 little-path path-1" d="M-429.2,276.8h6.3"/>
                        <path class="big-path big-path-1" d="M-438.1,279.3c0,0,20.5,0,20.6,0c4.1,0,7.4-3.4,7.7-7.4c0.1-1.1-0.1-2.3-0.6-3.3c-2.2-5.4-9.8-6.3-13.3-1.7
                            c-1,1.3-1.6,3-1.7,4.6"/>
                        <path class="little-path path-2" d="M-422.6,271.7c0-2.8,2.3-5.1,5.1-5.1s5.1,2.3,5.1,5.1c0,2.8-2.3,5.1-5.1,5.1"/>
                    </g>
                    <g>
                        <path class="little-path path-3" d="M-434.1,284.9h30.4"/>
                        <path class="little-path path-4" d="M-410.6,280h8.7"/>
                        <path class="big-path big-path-2" d="M-442.9,282.7h44c3.6,0,6.6,3,6.8,6.5c0.1,1-0.1,2-0.5,3c-2,4.8-8.7,5.5-11.8,1.5c-0.9-1.2-1.4-2.6-1.5-4.1"
                            />
                        <path class="little-path path-5" d="M-403.4,289.4c0,2.5,2,4.5,4.5,4.5s4.5-2,4.5-4.5s-2-4.5-4.5-4.5"/>
                    </g>
                </g>
            </svg>
        </div>`;
}

else{
    return `<div class="svg-contain">
            <svg version="1.1" class="clear-sky-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 72.3 52.6" style="enable-background:new 0 0 72.3 52.6;" xml:space="preserve">
                <g>
                    <path class="sun" d="M50.8,25.7c0,7.9-6.4,14.4-14.4,14.4s-14.4-6.4-14.4-14.4s6.4-14.4,14.4-14.4S50.8,17.8,50.8,25.7z"/>
                <path  class="line big-path line-1" d="M54.5,25.8h6"/>
                <path class="line big-path line-2" d="M12.4,25.8h6"/>
                <path class="line big-path line-3" d="M36.5,44.3v6"/>
                <path class="line big-path line-4" d="M36.5,8.2v-6"/>
                <path class="line big-path line-5" d="M23,38.8l-4.8,4.8"/>
                <path class="line big-path line-6" d="M54.9,8.9L50,13.8"/>
                <path class="line big-path line-7" d="M50,38.8l4.4,4.4"/>
                <path class="line big-path line-8" d="M18.8,9.6l4.2,4.2"/>
                </g>
            </svg>
        </div>`;
}
}

// Itinerary sidebar 
$(() => {
    let stickyTop = 0,
    scrollTarget = false;
  
    let timeline = $('.timeline_nav'),
    items = $('li', timeline),
    milestones = $('.timeline_section .milestone'),
    spans = $('.timeline_section .container');
    offsetTop = parseInt(timeline.css('top'));
  
    const TIMELINE_VALUES = {
      start: 190,
      step: 30 };
  
  
    $(window).resize(function () {
      timeline.removeClass('fixed');
  
      stickyTop = timeline.offset().top - offsetTop;
  
      $(window).trigger('scroll');
    }).trigger('resize');
  
    $(window).scroll(function () {
      if ($(window).scrollTop() > stickyTop) {
        timeline.addClass('fixed');
      } else {
        timeline.removeClass('fixed');
      }
    }).trigger('scroll');
  
  
  
    $(window).scroll(function () {
      let viewLine = $(window).scrollTop() + $(window).height(),
      active = -1;
  
      if (scrollTarget === false) {
        milestones.each(function () {
          if ($(this).offset().top - viewLine > 0) {
            return false;
          }
  
          active++;
        });
      } else {
        active = scrollTarget;
      }
  
      timeline.css('top', -1 * active * TIMELINE_VALUES.step + TIMELINE_VALUES.start + 'px');
  
      items.filter('.active').removeClass('active');
  
      items.eq(active != -1 ? active : 0).addClass('active');
    }).trigger('scroll');
  });