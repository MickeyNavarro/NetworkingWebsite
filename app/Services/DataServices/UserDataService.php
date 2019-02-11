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
use \PDO; 

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
    
    function login(UserModel $user){
        try {
            Log::info("Entering UserDataService.login()");
            
            //Select username and password and see if this row exists
            $username = $user->getUsername();
            $password = $user->getPassword(); 
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `Users` WHERE `USERNAME` = :user AND `PASSWORD` = :pass LIMIT 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':pass', $password);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //see if user existed and return true if found else return false if not found
                if ($stmt->rowCount() == 1) {
                    Log::info("Exiting UserDataService.login() with true");
                    return true;
                }
                else {
                    Log::info("Exiting UserDataService.login() with false");
                    return false;
                }
            }
            catch (PDOException $e){
                Log::error("Exception: ", array("message" => $e->getMessage()));
                throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
            }
    }
    
    function findById($id){        
        try {
            Log::info("Entering SecurityDAO.findById()");
        
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM Users WHERE ID = :id LIMIT 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UserDataService.findById() with returning null due to not finding a user");
                return null;
            }
            else{
                $personArray = array();
                
                while ($person = $stmt->fetch(PDO::FETCH_ASSOC)){
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
    
    function suspendById($id){
        try {
            Log::info("Entering SecurityDAO.suspendById()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `USERS` SET `SUSPEND` = '1' WHERE `USERS`.`ID` = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $suspend = $stmt->execute();
            
            if($suspend){
                Log::info("Exiting UserDataService.suspendById() with returning true");
                return true;
            }
            else{
                Log::info("Exiting UserDataService.suspendById() with returning false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    function deleteById($id){
        try {
            Log::info("Entering UserDataService.deleteById()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `USERS` WHERE `USERS`.`ID` = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $delete = $stmt->execute();
            
            if($delete){
                Log::info("Exiting UserDataService.deleteById() with returning true");
                return true;
            }
            else{
                Log::info("Exiting UserDataService.deleteById() with returning false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
        
}