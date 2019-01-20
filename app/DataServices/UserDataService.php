<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//interacts with the database and the User class data

namespace App\DataServices;

class UserdataService{
    
    // accepts a user object. Inserts a record into the perons table 
    function createNewUser($user){
           
        //Create a database objects and create a connection to the database
        $db = new Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("INSERT INTO `Users` (`FIRSTNAME`, `LASTNAME`, `EMAIL`, `USERNAME`, `PASSWORD`) VALUES (?,?,?,?,?);");
        
        if(!$stmt){
            echo "sql error in binding process";
            exit;
        }
        
        //Store the information from the user object into variables 
        $fn = $user->getFirstName();
        $ln = $user->getLastname();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();
        
        //Bind the variables from the user object to the SQL statement 
        $stmt->bind_param("sssss", $fn, $ln, $email, $username, $password);
        
        //Excecute the SQL statement 
        $stmt->execute();
        
        //If a row was inserted the method will return true. 
        //If not it will return false
        if($stmt->affected_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    function login($username, $password){
        
        $db = new Database();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM `Users` WHERE `USERNAME` = ? AND `PASSWORD` = ? LIMIT 1");
        
        if(!$stmt){
            echo "sql error in binding process";
            exit;
        }
        
        $stmt->bind_param("ss", $username, $password);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result) {
            $user = $result->fetch_assoc();
            
            if (mysqli_num_rows($result) == 1) {
                return $user['ID'];
            }
            else {
                return false;
                exit;
                
            }
        }
    }  
}