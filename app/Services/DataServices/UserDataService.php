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
use function GuzzleHttp\json_encode;

class UserDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a user object. Inserts a record into the perons table 
    function createNewUser(UserModel $user){
        try {
            Log::info("Entering UserDataService.createNewUser()"); 
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `USERS` (`FIRSTNAME`, `LASTNAME`, `EMAIL`, `USERNAME`, `PASSWORD`, `ROLE`, `SUSPEND`) VALUES (:first,:last,:email,:user,:pass, :role, :suspend);");
            
            //Store the information from the user object into variables
            $fn = $user->getFirstName();
            $ln = $user->getLastname();
            $email = $user->getEmail();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $role = $user->getRole(); 
            $suspend = $user->getSuspend(); 
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':first', $fn);
            $stmt->bindParam(':last', $ln);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':pass', $password);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':suspend', $suspend);
            
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
    //accepts a user object and matches the credential to a user in the database; returns a user ID
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
                    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
                    
                    Log::info("Exiting UserDataService.login() with user id");
                    return $user['ID']; 
                }
                else {
                    Log::info("Exiting UserDataService.login() with null");
                    return null;
                }
            }
            catch (PDOException $e){
                Log::error("Exception: ", array("message" => $e->getMessage()));
                throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
            }
    }
    //accepts the id and finds the user in the database with a matching id 
    function findById($id){        
        try {
            Log::info("Entering SecurityDAO.findById()");
        
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `USERS` WHERE ID = :id LIMIT 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UserDataService.findById() with returning null");
                return null;
            }
            else{
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $id = $user['ID'];
                $first = $user['FIRSTNAME'];
                $last = $user['LASTNAME'];
                $email = $user['EMAIL'];
                $username = $user['USERNAME']; 
                $pass = $user['PASSWORD']; 
                $role = $user['ROLE'];
                $suspend = $user['SUSPEND'];
                
                $uo = new UserModel($id, $first, $last, $email, $username, $pass, $role, $suspend); 
                 
                Log::info("Exiting UserDataService.findById() with returning a user object as a string");
                return $uo;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    //accepts an id and allows an admin role to suspend the user
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
    //accepts an id and allows an admin role to unsuspend the user
    function unsuspendById($id){
        try {
            Log::info("Entering SecurityDAO.suspendById()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `USERS` SET `SUSPEND` = '0' WHERE `USERS`.`ID` = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $suspend = $stmt->execute();
            
            if($suspend){
                Log::info("Exiting UserDataService.unsuspendById() with returning true");
                return true;
            }
            else{
                Log::info("Exiting UserDataService.unsuspendById() with returning false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    //accepts the id and allows an admin to delete the user
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
    
    //allows the admin to view all users
    function showAll(){
        try{
            Log::info("Entering UserDataService.showAll()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `USERS`");
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is any row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UserDataService.showAll() with returning null");
                return null;
            }
            else{ 
                $user_array = array();
                
                while ($user = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($user_array, $user);
                    
                }
                
                return $user_array;
                                
                Log::info("Exiting UserDataService.showAll() with an array of users");
                return $user_array;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}