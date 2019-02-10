<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//interacts with the database and the User class data

namespace App\Services\DataServices;

use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;

class UserDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a user object. Inserts a record into the perons table 
    function createNewUser($user){
        try {
            Log::info("Entering UserDataService.createNewUser()"); 
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `Users` (`FIRSTNAME`, `LASTNAME`, `EMAIL`, `USERNAME`, `PASSWORD`) VALUES (:first,:last,:email,:user,:pass);");
            
            //Store the information from the user object into variables
            $fn = $user->getFirstName();
            $ln = $user->getLastname();
            $email = $user->getEmail();
            $username = $user->getUsername();
            $password = $user->getPassword();
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':first', $fn);
            $stmt->bindParam(':last', $ln);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':pass', $password);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting UserDataService.createNewUser() with true");
                return true;
            }
            else {
                Log::info("Exiting UserDataService.createNewUser()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    function login($username, $password){
        try {
            Log::info("Entering UserDataService.login()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `Users` WHERE `USERNAME` = :user AND `PASSWORD` = :pass LIMIT 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':pass', $password);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //get the results
            $result = $stmt->get_result();
            
            if ($result) {
                $user = $result->fetch_assoc();
                
                if (mysqli_num_rows($result) == 1) {
                    Log::info("Exiting UserDataService.login() with returning the user");
                    return $user['ID'];
                }
                else {
                    Log::info("Exiting UserDataService.login()with false");
                    return false;
                    
                }
            }
            }catch (PDOException $e){
                Log::error("Exception: ", array("message" => $e->getMessage()));
                throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
            }
    }
    
    function findById($id){
        Log::info("Entering SecurityDAO.findById()");
        
        try {
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM Users WHERE ID = :id LIMIT 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //get the results
            $result = $stmt->get_result();
            
            if($result->num_rows == 0){
                Log::info("Exiting UserDataService.findById() with returning null due to not finding a user");
                return null;
            }
            else{
                $personArray = array();
                
                while ($person = $result->fetch_assoc()){
                    array_push($personArray, $person);
                }
                
                $p = new UserModel($personArray[0]['ID'], $personArray[0]['FIRSTNAME'], $personArray[0]['LASTNAME'], $personArray[0]['EMAIL'], $personArray[0]['USERNAME'], $personArray[0]['PASSWORD'], $personArray[0]['ROLE']);
                
                Log::info("Exiting UserDataService.findById() with returning an array of the person found"); 
                return $p;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }   
}
