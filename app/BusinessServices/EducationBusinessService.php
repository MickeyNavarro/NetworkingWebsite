<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the education class data

namespace App\Services\BusinessServices;

use App\Models\EducationModel;
use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Services\DataServices\EducationDataService;

class EducationBusinessService
{ 
    // accepts an education object; creates a connection; inserts a record into the education table
    function create(EducationModel $edu){
        Log::info("Entering EducationBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a EducationDataService with this connection 
        $service = new EducationDataService($conn); 
        $flag = $service->create($edu);
        
        //Return the finder results
        Log::info("Exit EducationBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an user id; creates a connection; returns data from the education class
    function readByUserID($id){
        Log::info("Entering EducationBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a EducationDataService with this connection
        $service = new EducationDataService($conn);
        $flag = $service->readByUserID($id); 
        
        //Return the finder results
        Log::info("Exit EducationBusinessService.readByUserID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts an education id; creates a connection; returns data from the education class
    function readByEduID($id){
        Log::info("Entering EducationBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a EducationDataService with this connection
        $service = new EducationDataService($conn);
        $flag = $service->readByEduID($id);
        
        //Return the finder results
        Log::info("Exit EducationBusinessService.readByEduID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts an education object; creates a connection; updates a record in the education table 
    function update(EducationModel $edu) { 
        Log::info("Entering EducationBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a EducationDataService with this connection 
        $service = new EducationDataService($conn); 
        $flag = $service->update($edu); 
        
        //return the finder results 
        Log::info("Exit EducationBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts an id; creates a connection; deletes a record from the education table 
    function delete($id) { 
        Log::info("Entering EducationBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a EducationDataService with this connection
        $service = new EducationDataService($conn);
        $flag = $service->delete($id);
        
        //return the finder results
        Log::info("Exit EducationBusinessService.delete() with " . $flag);
        return $flag;
    }
}
