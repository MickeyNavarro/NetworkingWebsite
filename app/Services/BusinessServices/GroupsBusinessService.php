<?php
//Almicke Navarro
//2-26-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the groups class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Services\DataServices\GroupsDataService;
use App\Models\GroupsModel;

class GroupsBusinessService
{ 
    // accepts an groups object; creates a connection; inserts a record into the groups table
    function create(GroupsModel $group){
        Log::info("Entering GroupsBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a GroupsDataService with this connection 
        $service = new GroupsDataService($conn); 
        $flag = $service->create($group); 
        
        //Return the finder results
        Log::info("Exit GroupsBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an id; creates a connection; returns data from the groups class
    function readByGroupId($id){
        Log::info("Entering GroupsBusinessService.readByGroupId()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a GroupsDataService with this connection
        $service = new GroupsDataService($conn);
        $flag = $service->readByGroupId($id); 
        
        //Return the finder results
        Log::info("Exit GroupsBusinessService.readByGroupId() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts an id; creates a connection; returns all the groups from the groups class
    function readAll(){
        Log::info("Entering GroupsBusinessService.readByGroupId()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a GroupsDataService with this connection
        $service = new GroupsDataService($conn);
        $flag = $service->readAll(); 
        
        //Return the finder results
        Log::info("Exit GroupsBusinessService.readByGroupId() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a groups object; creates a connection; updates a record in the groups table 
    function update(GroupsModel $group) { 
        Log::info("Entering GroupsBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a GroupsDataService with this connection 
        $service = new GroupsDataService($conn);
        $flag = $service->update($group);  
        
        //return the finder results 
        Log::info("Exit GroupsBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts an id; creates a connection; deletes a record from the groups table 
    function delete($id) { 
        Log::info("Entering GroupsBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a GroupsDataService with this connection
        $service = new GroupsDataService($conn);
        $flag = $service->delete($id);  
        
        //return the finder results
        Log::info("Exit GroupsBusinessService.delete() with " . $flag);
        return $flag;
    }
}
