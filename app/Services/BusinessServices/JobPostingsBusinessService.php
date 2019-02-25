<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the job postings class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Models\JobPostingsModel;
use App\Services\DataServices\JobPostingsDataService;

class JobPostingsBusinessService
{ 
    // accepts a job postings object; creates a connection; inserts a record into the job postings table
    function create(JobPostingsModel $job){
        Log::info("Entering JobPostingsBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a JobPostingsDataService with this connection 
        $service = new JobPostingsDataService($conn); 
        $flag = $service->create($job); 
        
        //Return the finder results
        Log::info("Exit JobPostingsBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts a job postings id; creates a connection; returns data from the job postings class
    function readByJobID($id){
        Log::info("Entering JobPostingsBusinessService.readByJobID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a JobPostingsDataService with this connection
        $service = new JobPostingsDataService($conn);
        $flag = $service->readByJobID($id);
        
        //Return the finder results
        Log::info("Exit JobPostingsBusinessService.readByJobID() with " . json_encode($flag));
        return $flag;
    }
    
    // creates a connection; returns all job postings from database
    function readAll(){
        Log::info("Entering JobPostingsBusinessService.readAll()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a JobPostingsDataService with this connection and find all the job postings 
        $service = new JobPostingsDataService($conn); 
        $flag = $service->readAll(); 
        
        //Return the finder results
        Log::info("Exit JobPostingsBusinessService.readAll() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a job postings object; creates a connection; updates a record in the job postings table 
    function update(JobPostingsModel $job) { 
        Log::info("Entering JobPostingsBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a JobPostingsDataService with this connection 
        $service = new JobPostingsDataService($conn);
        $flag = $service->update($job);  
        
        //return the finder results 
        Log::info("Exit JobPostingsBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts a job postings id; creates a connection; deletes a record from the job postings table 
    function delete($id) { 
        Log::info("Entering JobPostingsBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a JobPostingsDataService with this connection
        $service = new JobPostingsDataService($conn);
        $flag = $service->delete($id); 
        
        //return the finder results
        Log::info("Exit JobPostingsBusinessService.delete() with " . $flag);
        return $flag;
    }
}
