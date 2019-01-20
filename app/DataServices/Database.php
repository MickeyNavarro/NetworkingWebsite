<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//Connects to the database 

namespace App\DataServices;

class Database{
    
    private $dbservername = "localhost";
    private $dbusername = "root";
    private $dbpassword = "root";
    private $dbname = "NetworkingWebsite";
    
    function getConnection(){
        $conn = mysqli_connect($this->dbservername, $this->dbusername, $this->dbpassword, $this->dbname);
        
        if($conn->connect_error){
            echo "Connection failed" . $conn-> connect_error . "<br>";
        }
        else{
            return $conn;
        }
        
    }
}