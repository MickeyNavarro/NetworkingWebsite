<?php
//Almicke Navarro
//3-1-19
//Networking Milestone
//This is my own work.
//creates a database connection 

//this class is not in use yet

namespace App\Services\Utility;

use \PDO; 

class DatabaseConnection
{ 
    //Get credentials for accessing the database
    private static $servername = config("database.connections.mysql.host");
    private static $username = config("database.connections.mysql.username");
    private static $password = config("database.connections.mysql.password");
    private static $dbname = config("database.connections.mysql.database");
    
    static function getConnection() { 
        //create connection
        $conn = new PDO("mysql:host=" . $this->servername. ";dbname= ". $this->dbname. ", " . $this->username . ", " .$this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
}

