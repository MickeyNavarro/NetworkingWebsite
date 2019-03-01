<?php
//Almicke Navarro
//2-23-19
//Networking Milestone
//This is my own work.
//interacts with the database and the addresses data

namespace App\Services\DataServices; 

use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 
use App\Models\AddressesModel;

class AddressesDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a AddressesModel object; Inserts a record into the Addresses table
    function create(AddressesModel $addy){
        try {
            Log::info("Entering AddressesDataService.create()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `ADDRESSES` (`CITY`, `STATE`, `COUNTRY`) VALUES (:city, :state, :country))");
            
            //Store the information from the addresses object into variables
            $city = $addy->getCity(); 
            $state = $addy->getState(); 
            $country = $addy->getCountry(); 
            
            //Bind the variables from the addresses object to the SQL statement
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':country', $country);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting AddressesDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting AddressesDataService.create()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    //accepts the id and finds the address in the database with a matching id
    function read($id){
        try {
            Log::info("Entering AddressesDataService.read()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `ADDRESSES` WHERE `ID` = :id");
            
            //Bind the variables from the given id to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting AddressesDataService.read() with returning null");
                return null;
            }
            else{
                
                //fetch all the address data
                $addy = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the address data
                $id = $addy['ID'];
                $city = $addy['CITY'];
                $state = $addy['STATE'];
                $country = $addy['COUNTRY']; 
                
                
                //create a new address object with the data from above
                $addy_ob = new AddressesModel($id, $city, $state, $country); 
    
                Log::info("Exiting AddressesDataService.read() with returning an address object");
                return $addy_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts a address model; updates the addresses model in the database
    function update(AddressesModel $addy) {
        try {
            Log::info("Entering AddressesDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `ADDRESSES` SET `CITY`= :city,`STATE`= :state,`COUNTRY`= :country WHERE  `ID`=:id");
            
            //Store the information into variables
            $city = $addy->getCity(); 
            $state = $addy->getState(); 
            $country = $addy->getCountry(); 
            $id = $addy->getId(); 
            
            //Bind the variables from the addresses object to the SQL statement
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state); 
            $stmt->bindParam(':country', $country); 
            $stmt->bindParam(':id', $id);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting AddressesDataService.update() with true");
                return true;
            }
            else {
                Log::info("Exiting AddressesDataService.update()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the address in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering AddressesDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `ADDRESSES`  WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting AddressesDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting AddressesDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
}