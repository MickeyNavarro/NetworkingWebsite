<?php
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the skills class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Models\SkillsModel;
use App\Services\DataServices\SkillsDataService;

class SkillsBusinessService
{ 
    // accepts an skills object; creates a connection; inserts a record into the skills table
    function create(SkillsModel $skill){
        Log::info("Entering SkillsBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a SkillsDataService with this connection 
        $service = new SkillsDataService($conn); 
        $flag = $service->create($skill); 
        
        //Return the finder results
        Log::info("Exit SkillsBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an user id; creates a connection; returns data from the skills class
    function readByUserID($id){
        Log::info("Entering SkillsBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a SkillsDataService with this connection
        $service = new SkillsDataService($conn);
        $flag = $service->readByUserID($id);  
        
        //Return the finder results
        Log::info("Exit SkillsBusinessService.readByUserID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts an skills id; creates a connection; returns data from the skills class
    function readBySkillID($id){
        Log::info("Entering SkillsBusinessService.readBySkillID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a SkillsDataService with this connection
        $service = new SkillsDataService($conn);
        $flag = $service->readBySkillID($id); 
        
        //Return the finder results
        Log::info("Exit SkillsBusinessService.readBySkillID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a skills object; creates a connection; updates a record in the skills table 
    function update(SkillsModel $skill) { 
        Log::info("Entering SkillsBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a SkillsDataService with this connection 
        $service = new SkillsDataService($conn); 
        $flag = $service->update($skill);  
        
        //return the finder results 
        Log::info("Exit SkillsBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts a skills id; creates a connection; deletes a record from the skills table 
    function delete($id) { 
        Log::info("Entering SkillsBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a SkillsDataService with this connection
        $service = new SkillsDataService($conn);
        $flag = $service->delete($id);  
        
        //return the finder results
        Log::info("Exit SkillsBusinessService.delete() with " . $flag);
        return $flag;
    }
}
