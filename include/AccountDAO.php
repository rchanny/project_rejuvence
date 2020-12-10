<!--

    DO NOT MODIFY THIS FILE

-->
<?php

require_once 'common.php';

class AccountDAO {
    public function verifyEmail($email){
            // Step 1 - Connect to Database
            $connMgr = new ConnectionManager();
            $pdo = $connMgr->getConnection();

             // Step 2 - Prepare SQL
          $sql= "SELECT
                      *
                  FROM
                      user
                  WHERE
                      email = :email
          ";
           $stmt = $pdo->prepare($sql);
           $stmt->bindParam(':email', $email, PDO::PARAM_STR);
           $stmt->setFetchMode(PDO::FETCH_ASSOC);
           $stmt->execute();
           
           // Step 4 - Retrieve Query Results
          if( $stmt->rowCount() >=1 ) {
              $result=true;
          }else{
              $result=false;
          }

          // Step 5 - Clear Resources
          $stmt = null;
          $pdo = null;
    
          // Step 6 - Return
          return $result;
          //return false; // DEBUG
    }

    public function getUserId($email){
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();


         // Step 2 - Prepare SQL
      $sql= "SELECT
                  id
              FROM
                  user
              WHERE
                  email = :email
      ";
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':email', $email, PDO::PARAM_STR);
       $stmt->setFetchMode(PDO::FETCH_ASSOC);

       $id=null;

      if( $stmt->execute() ) {

          // Step 4 - Retrieve Query Results
          if( $row = $stmt->fetch() ) {
              $id = $row['id'];
          }
      }
   
      // Step 5 - Clear Resources
      $stmt = null;
      $pdo = null;

      // Step 6 - Return
      return $id;
      //return false; // DEBUG
  }
             
  public function updateProfileName($email,$fullname) {

    $conn= new ConnectionManager();
    $pdo = $conn->getConnection();
    $sql="UPDATE user 
    SET fullname=:fullname 
    WHERE email=:email";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":fullname",$fullname,PDO::PARAM_STR);
    $stmt->bindParam(":email",$email,PDO::PARAM_STR);

    $isOk=$stmt->execute();

    $stmt=null;
    $pdo=null;


    return $isOk;

 }

  public function register($email,$fullname,$hashed_password,$categories_string) {

      // Step 1 - Connect to Database
      $connMgr = new ConnectionManager();
      $pdo = $connMgr->getConnection();

      // Step 2 - Prepare SQL
      $sql = "INSERT INTO user (email,fullname,hashed_password,categories)
              VALUES (:email,:fullname,:hashed_password,:categories);
      ";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
      $stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
      $stmt->bindParam(':categories', $categories_string, PDO::PARAM_STR);
      
      // Step 3 - Execute SQL
      $result = $stmt->execute();
    

      // Step 5 - Clear Resources
      $stmt = null;
      $pdo = null;

      // Step 6 - Return
      return $result;
      //return false; // DEBUG
  }
  
    public function getName($email){
         // Step 1 - Connect to Database
         $connMgr = new ConnectionManager();
         $pdo = $connMgr->getConnection();
 
         // Step 2 - Prepare SQL
         $sql = "SELECT
                     fullname
                 FROM
                     user
                 WHERE
                     email = :email
         ";
         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         
         // Step 3 - Execute SQL
         $fullname = null;
         
         if( $stmt->execute() ) {
 
             // Step 4 - Retrieve Query Results
             if( $row = $stmt->fetch() ) {
                 $fullname = $row['fullname'];
             }
         }
         
         // Step 5 - Clear Resources
         $stmt = null;
         $pdo = null;
 
         // Step 6 - Return
         return $fullname;

    }

    public function getCategories($email){
          // Step 1 - Connect to Database
          $connMgr = new ConnectionManager();
          $pdo = $connMgr->getConnection();
  
          // Step 2 - Prepare SQL
          $sql = "SELECT
                      categories
                  FROM
                      user
                  WHERE
                      email = :email
          ";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          
          // Step 3 - Execute SQL
          $categories = null;
          
          if( $stmt->execute() ) {
  
              // Step 4 - Retrieve Query Results
              if( $row = $stmt->fetch() ) {
                  $categories = $row['categories'];
              }
          }
          
          // Step 5 - Clear Resources
          $stmt = null;
          $pdo = null;
  
          // Step 6 - Return
          return $categories;
 

    }

    public function getHashedPassword($email) {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    hashed_password
                FROM
                    user
                WHERE
                    email = :email
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Step 3 - Execute SQL
        $hashed_password = null;
        
        if( $stmt->execute() ) {

            // Step 4 - Retrieve Query Results
            if( $row = $stmt->fetch() ) {
                $hashed_password = $row['hashed_password'];
            }
        }
        
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $hashed_password;
    }

    public function getItineraryId($user_id){
        
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    itinerary_id
                FROM
                     itineraries
                WHERE
                    id = :id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Step 3 - Execute SQL
        $itinerary_id = null;
        
        if( $stmt->execute() ) {

            // Step 4 - Retrieve Query Results
            if( $row = $stmt->fetch() ) {
                $itinerary_id = $row['itinerary_id'];
            }
        }
        
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $itinerary_id;

    }

    public function getItineraryName($user_id){
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT itinerary_name
            FROM itineraries
            WHERE id=:id ;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Step 3 - Execute SQL
        $stmt->execute(); 

        $itinerary_names = [];
        while ( $row = $stmt->fetch() ) {
            $itinerary = $row['itinerary_name'];
            $itinerary_names[] = $itinerary;
        }
          
        
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $itinerary_names;

    }

    public function getIndividualItineraryName($user_id, $iti_id){
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT itinerary_name
            FROM itineraries
            WHERE id=:id 
            AND itinerary_id = :iti_id;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':iti_id', $iti_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Step 3 - Execute SQL

        $itinerary_name = '';

        if( $stmt->execute() ) {
  
            // Step 4 - Retrieve Query Results
            if( $row = $stmt->fetch() ) {
                $itinerary_name = $row['itinerary_name'];
            }
        }
        
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $itinerary_name;

    }

    public function getItineraryNameAndID($user_id){
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT itinerary_name, itinerary_id
            FROM itineraries
            WHERE id=:id ;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Step 3 - Execute SQL
        $stmt->execute(); 

        $itinerary_array = [];
        while ( $row = $stmt->fetch() ) {
            $itinerary = [];
            $itinerary['itinerary_name'] = $row['itinerary_name'];
            $itinerary['itinerary_id'] = $row['itinerary_id'] ;
            $itinerary_array[] = $itinerary;
        }
          
        
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $itinerary_array;
    }


    public function createItinerary($user_id,$itinerary_name){
        
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "INSERT INTO itineraries (id,itinerary_name)
                VALUES (:id,:itinerary_name);
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':itinerary_name', $itinerary_name, PDO::PARAM_STR);

        // Step 3 - Execute SQL
        $result = $stmt->execute();

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $result;
        //return false; // DEBUG

    }


    public function createItinerariesItem($itinerary_id,$uuid, $attraction_name, $attraction_category, $itinerary_date,$start_time,$end_time){
        
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "INSERT INTO itinerary_details (itinerary_id, uuid, attraction_name, attraction_category, itinerary_date,START_TIME,END_TIME)
                VALUES (:itinerary_id,:uuid,:attraction_name, :attraction_category, :itinerary_date, :START_TIME,:END_TIME);
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':itinerary_id', $itinerary_id, PDO::PARAM_INT);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->bindParam(':attraction_name', $attraction_name, PDO::PARAM_STR);
        $stmt->bindParam(':attraction_category', $attraction_category, PDO::PARAM_STR);
        $stmt->bindParam(':itinerary_date', $itinerary_date, PDO::PARAM_STR);
        $stmt->bindParam(':START_TIME', $start_time, PDO::PARAM_STR);
        $stmt->bindParam(':END_TIME', $end_time, PDO::PARAM_STR);


        // Step 3 - Execute SQL
        $result = $stmt->execute();

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $result;
        //return false; // DEBUG
    }


    public function getItineraryAttractions($itinerary_id) {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT  
                    *
                FROM 
                    itinerary_details
                WHERE 
                    itinerary_id = :itinerary_id
                ORDER BY
                    itinerary_date ;

        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':itinerary_id', $itinerary_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Step 3 - Execute SQL
        $stmt->execute(); 

        $itinerary_attractions_array = [];
        while ( $row = $stmt->fetch() ) {
            $itinerary_attractions = [];
            $itinerary_attractions['itinerary_id'] = $row['itinerary_id'];
            $itinerary_attractions['uuid'] = $row['uuid'];
            $itinerary_attractions['attraction_name'] = $row['attraction_name'];
            $itinerary_attractions['itinerary_date'] = $row['itinerary_date'];
            $itinerary_attractions['attraction_category'] = $row['attraction_category'];
            $itinerary_attractions['START_TIME'] = $row['START_TIME'];
            $itinerary_attractions['END_TIME'] = $row['END_TIME'];
            $itinerary_attractions_array[] = $itinerary_attractions;
        }
          
        
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $itinerary_attractions_array;

    }


    public function deleteItinerary($user_id, $itinerary_id){
        
        $conn= new ConnectionManager();
        $pdo = $conn->getConnection();
        $sql="DELETE FROM itineraries 
        WHERE id = :user_id
        AND itinerary_id=:itinerary_id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":itinerary_id",$itinerary_id,PDO::PARAM_INT);
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
      

        $isOk=$stmt->execute();

        $stmt=null;
        $pdo=null;


        return $isOk;

    }

    public function deleteItineraryAttractions($start_time,$itinerary_id,$itinerary_date){

        $conn= new ConnectionManager();
        $pdo = $conn->getConnection();
        $sql="DELETE FROM itinerary_details 
        WHERE START_TIME = :start_time
        AND itinerary_date = :itinerary_date
        AND itinerary_id = :itinerary_id";

        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":itinerary_id",$itinerary_id,PDO::PARAM_INT);
        $stmt->bindParam(":start_time",$start_time,PDO::PARAM_STR);
        $stmt->bindParam(":itinerary_date",$itinerary_date,PDO::PARAM_STR);
      

        $isOk=$stmt->execute();

        $stmt=null;
        $pdo=null;


        return $isOk;

        
    }

    // Update attraction preferences
    public function updatePreference($user_id, $categories_string) {

        // STEP 1 - Connect to MySQL Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // STEP 2 - Prepare SQL Query
        $sql = "UPDATE 
                    user
                SET 
                    categories = :categories_string
                WHERE
                    id = :user_id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindPARAM(':categories_string', $categories_string, PDO::PARAM_STR);
        $stmt->bindPARAM(':user_id', $user_id, PDO::PARAM_INT);

        // STEP 3 - Run Query
        $isOk = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $pdo = null;        
        
        // STEP 5
        return $isOk;
    }



}

?>