<?php
//Almicke Navarro
//2-28-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the users jobs postings class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Models\UsersJobPostingsModel;
use App\Services\DataServices\UsersJobPostingsDataService;

class UsersJobPostingsBusinessService
{ 
    // accepts an users jobs posting object; creates a connection; inserts a record into the users job postings table
    function create(UsersJobPostingsModel $uj){
        Log::info("Entering UsersJobPostingsBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a UsersJobPostingsDataService with this connection 
        $service = new UsersJobPostingsDataService($conn); 
        $flag = $service->create($uj); 
        
        //Return the finder results
        Log::info("Exit UsersJobPostingsBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an user id; creates a connection; returns data from the users groups class
    function readByUserID($id){
        Log::info("Entering UsersJobPostingsBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a UsersJobPostingsDataService with this connection
        $service = new UsersJobPostingsDataService($conn);
        $flag = $service->readByUserID($id); 
        
        //Return the finder results
        Log::info("Exit UsersJobPostingsBusinessService.readByUserID() with " . json_encode($flag));
        return $flag;
    }
    
    
    // accepts a user id; creates a connection; deletes a record from the users groups table 
    function delete($id) { 
        Log::info("Entering UsersJobPostingsBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a UsersJobPostingsDataService with this connection
        $service = new UsersJobPostingsDataService($conn);
        $flag = $service->delete($id); 
        
        //return the finder results
        Log::info("Exit UsersJobPostingsBusinessService.delete() with " . $flag);
        return $flag;
    }
}
