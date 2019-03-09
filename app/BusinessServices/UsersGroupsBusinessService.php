<?php
//Almicke Navarro
//2-27-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the users groups class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Models\SkillsModel;
use App\Models\UsersGroupsModel;
use App\Services\DataServices\UsersGroupsDataService;

class UsersGroupsBusinessService
{ 
    // accepts an users groups object; creates a connection; inserts a record into the users groups table
    function create(UsersGroupsModel $ug){
        Log::info("Entering UsersGroupsBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a UsersGroupsDataService with this connection 
        $service = new UsersGroupsDataService($conn); 
        $flag = $service->create($ug); 
        
        //Return the finder results
        Log::info("Exit UsersGroupsBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an user id; creates a connection; returns data from the users groups class
    function readByUserID($id){
        Log::info("Entering UsersGroupsBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a UsersGroupsDataService with this connection
        $service = new UsersGroupsDataService($conn);
        $flag = $service->readByUserID($id); 
        
        //Return the finder results
        Log::info("Exit UsersGroupsBusinessService.readByUserID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a group id; creates a connection; returns data from the users groups class
    function readByGroupID($id){
        Log::info("Entering UsersGroupsBusinessService.readByGroupID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a UsersGroupsDataService with this connection
        $service = new UsersGroupsDataService($conn);
        $flag = $service->readByGroupID($id); 
        
        //Return the finder results
        Log::info("Exit UsersGroupsBusinessService.readByGroupID() with " . json_encode($flag));
        return $flag;
    }
    
    
    // accepts a user id; creates a connection; deletes a record from the users groups table 
    function delete($id) { 
        Log::info("Entering UsersGroupsBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a UsersGroupsDataService with this connection
        $service = new UsersGroupsDataService($conn);
        $flag = $service->delete($id); 
        
        //return the finder results
        Log::info("Exit UsersGroupsBusinessService.delete() with " . $flag);
        return $flag;
    }
}
