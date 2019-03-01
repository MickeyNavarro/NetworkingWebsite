<?php
//Almicke Navarro
//2-26-19
//Networking Milestone
//This is my own work.
//opens a connection with the database and interacts with the addresses class data

namespace App\Services\BusinessServices;

use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;
use App\Models\AddressesModel;
use App\Services\DataServices\AddressesDataService;

class AddressesBusinessService
{ 
    // accepts an address object; creates a connection; inserts a record into the addresses table
    function create(AddressesModel $addy){
        Log::info("Entering AddressesBusinessService.create()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a AddressesDataService with this connection 
        $service = new AddressesDataService($conn);  
        $flag = $service->create($addy); 
        
        //Return the finder results
        Log::info("Exit AddressesBusinessService.create() with " . $flag);
        return $flag;
    }
    
    // accepts an id; creates a connection; returns data from the addresses class
    function read($id){
        Log::info("Entering AddressesBusinessService.read()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a AddressesDataService with this connection
        $service = new AddressesDataService($conn);
        $flag = $service->read($id);   
        
        //Return the finder results
        Log::info("Exit AddressesBusinessService.read() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts an address object; creates a connection; updates a record in the addresses table 
    function update(AddressesModel $addy) { 
        Log::info("Entering AddressesBusinessService.update()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a AddressesDataService with this connection 
        $service = new AddressesDataService($conn);
        $flag = $service->update($addy);   
        
        //return the finder results 
        Log::info("Exit AddressesBusinessService.update() with " . $flag);
        return $flag;
    }
    
    // accepts an id; creates a connection; deletes a record from the addresses table 
    function delete($id) { 
        Log::info("Entering AddressesBusinessService.delete()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a AddressesDataService with this connection
        $service = new AddressesDataService($conn);
        $flag = $service->delete($id);  
        
        //return the finder results
        Log::info("Exit AddressesBusinessService.delete() with " . $flag);
        return $flag;
    }
}
