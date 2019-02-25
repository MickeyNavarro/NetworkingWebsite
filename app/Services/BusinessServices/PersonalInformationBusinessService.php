<?php
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the personal information class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Models\PersonalInformationModel;
use App\Services\DataServices\PersonalInformationDataService;

class PersonalInformationBusinessService
{ 
    // accepts an personal info object; creates a connection; inserts a record into the personal info table
    function create(PersonalInformationModel $pi){
        Log::info("Entering PersonalInformationBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a PersonalInformationDataService with this connection 
        $service = new PersonalInformationDataService($conn);  
        $flag = $service->create($pi); 
        
        //Return the finder results
        Log::info("Exit PersonalInformationBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an user id; creates a connection; returns data from the personal info class
    function readByUserID($id){
        Log::info("Entering PersonalInformationBusinessService.readByUserID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a PersonalInformationDataService with this connection
        $service = new PersonalInformationDataService($conn);
        $flag = $service->readByUserID($id);  
        
        //Return the finder results
        Log::info("Exit PersonalInformationBusinessService.readByUserID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a personal info id; creates a connection; returns data from the personal info class
    function readByPersonalInfoID($id){
        Log::info("Entering PersonalInformationBusinessService.readByPersonalInfoID()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a PersonalInformationDataService with this connection
        $service = new PersonalInformationDataService($conn);
        $flag = $service->readByPersonalInfoID($id);
        
        //Return the finder results
        Log::info("Exit PersonalInformationBusinessService.readByPersonalInfoID() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a personal info object; creates a connection; updates a record in the personal info table 
    function update(PersonalInformationModel $pi) { 
        Log::info("Entering PersonalInformationBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a PersonalInformationDataService with this connection 
        $service = new PersonalInformationDataService($conn); 
        $flag = $service->update($pi); 
        
        //return the finder results 
        Log::info("Exit PersonalInformationBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts a personal info id; creates a connection; deletes a record from the personal info table 
    function delete($id) { 
        Log::info("Entering PersonalInformationBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a PersonalInformationDataService with this connection
        $service = new PersonalInformationDataService($conn);
        $flag = $service->delete($id);
        
        //return the finder results
        Log::info("Exit PersonalInformationBusinessService.delete() with " . $flag);
        return $flag;
    }
}
