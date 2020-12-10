<!--

    DO NOT MODIFY THIS FILE

    EXCEPT for:
        - username
        - password
        - port

-->
<?php

class ConnectionManager {

    public function getConnection() {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'rejuvence';
        $port = '3308';
        
        // Create connection
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;port=$port",
                        $username,
                        $password);     

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if fail, exception will be thrown

        // Return connection object
        return $pdo;
    }

}