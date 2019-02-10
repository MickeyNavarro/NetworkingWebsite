<?php

<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//interacts with the User class data with business specifications

namespace App\Services\BusinessServices;

use \PDO;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;
use App\Services\DataServices\UserDataService;

class UserBusinessService{
    
    function createNewUser($user){
        Log::info("Entering UserBusinessService.createNewUser()");
        
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
        $flag = $service->createNewUser($user);
        
        //Return the finder results
        Log::info("Exit UserBusinessService.createNewUser() with " . $flag);
        return $flag;
    }
    
    
    function login($username, $password){
        Log::info("Entering UserBusinessService.login()");
        
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
        $flag = $service->login($username, $password);
        
        //Return the finder results
        Log::info("Exit UserBusinessService.login() with " . $flag);
        return $flag;
    }
    
    function findById($id){
        Log::info("Entering UserBusinessService.findById()");
        
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
        $flag = $service->findById($id);
        
        //Return the finder results
        Log::info("Exit UserBusinessService.findById() with " . $flag);
        return $flag;
    }
      
}
