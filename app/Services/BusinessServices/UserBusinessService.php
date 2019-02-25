<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//interacts with the User class data with business specifications

namespace App\Services\BusinessServices;

use App\Models\UsersModel;
use App\Services\DataServices\UserDataService;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 

class UserBusinessService{
    
    // accepts a usermodel object. Inserts a record into the users table
    function create(UsersModel $user){
        Log::info("Entering UserBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->create($user); 
        
        //Return the finder results
        Log::info("Exit UserBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts a usermodel object. returns a record from the users table
    function readByCredentials(UsersModel $user){
        Log::info("Entering UserBusinessService.readByCredentials()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->readByCredentials($user); 
        
        //Return the finder results
        Log::info("Exit UserBusinessService.readByCredentials() with " . $flag);
        return $flag;
    }
    
    // accepts a user id. returns a record from the users table
    function readByUserId($id){
        Log::info("Entering UserBusinessService.readByUserId()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->readByUserId($id); 
        
        //make sure to change the $flag variable into a string to allow for logging
        json_encode($flag);
        
        //Return the finder results
        Log::info("Exit UserBusinessService.readByUserId() with " . json_encode($flag));
        return $flag;
    }
    
    // returns all the users in an array
    function readAll(){
        Log::info("Entering UserBusinessService.readAll()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->readAll(); 
        
        //Return the finder results
        Log::info("Exit UserBusinessService.readAll() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a user id. returns bool on if a user was suspended or not
    function suspendById($id){
        Log::info("Entering UserBusinessService.suspendById()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->suspendById($id);
        
        //Return the finder results
        Log::info("Exit UserBusinessService.suspendById() with " . $flag);
        return $flag;
    }
    
    // accepts a user id. returns bool on if a user was unsuspended or not
    function unsuspendById($id){
        Log::info("Entering UserBusinessService.unsuspendById()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->unsuspendById($id);
        
        //Return the finder results
        Log::info("Exit UserBusinessService.unsuspendById() with " . $flag);
        return $flag;
    }
    
    // accepts a user id. returns bool on if a user was deleted or not
    function delete($id){
        Log::info("Entering UserBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new UserDataService($conn);
        $flag = $service->delete($id); 
        
        //Return the finder results
        Log::info("Exit UserBusinessService.delete() with " . $flag);
        return $flag;
    }
    
    
      
}