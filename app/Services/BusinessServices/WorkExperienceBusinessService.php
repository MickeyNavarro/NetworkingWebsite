<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the work experience class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Services\DataServices\EducationDataService;
use App\Models\WorkExperienceModel;
use App\Services\DataServices\WorkExperienceDataService;

class WorkExperienceBusinessService
{ 
    // accepts an education object; creates a connection; inserts a record into the work experience table
    function create(WorkExperienceModel $work){
        Log::info("Entering WorkExperienceBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a WorkExperienceDataService with this connection 
        $service = new WorkExperienceDataService($conn); 
        $flag = $service->create($work); 
        
        //Return the finder results
        Log::info("Exit WorkExperienceBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an user id; creates a connection; returns data from the work experience class
    function readByUserID($id){
        Log::info("Entering WorkExperienceBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a WorkExperienceDataService with this connection
        $service = new WorkExperienceDataService($conn);
        $flag = $service->readByUserID($id);  
        
        //Return the finder results
        Log::info("Exit WorkExperienceBusinessService.readByUserID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts an work experience id; creates a connection; returns data from the work experience class
    function readByWorkID($id){
        Log::info("Entering WorkExperienceBusinessService.readByWorkID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a WorkExperienceDataService with this connection
        $service = new WorkExperienceDataService($conn);
        $flag = $service->readByWorkID($id);
        
        //Return the finder results
        Log::info("Exit WorkExperienceBusinessService.readByWorkID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a work experience object; creates a connection; updates a record in the work experience table 
    function update(WorkExperienceModel $work) { 
        Log::info("Entering WorkExperienceBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a WorkExperienceDataService with this connection 
        $service = new WorkExperienceDataService($conn); 
        $flag = $service->update($work);  
        
        //return the finder results 
        Log::info("Exit WorkExperienceBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts a work experience id; creates a connection; deletes a record from the work experience table 
    function delete($id) { 
        Log::info("Entering WorkExperienceBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a WorkExperienceDataService with this connection
        $service = new WorkExperienceDataService($conn);
        $flag = $service->delete($id); 
        
        //return the finder results
        Log::info("Exit WorkExperienceBusinessService.delete() with " . $flag);
        return $flag;
    }
}
