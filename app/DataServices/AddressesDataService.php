<?php
//Almicke Navarro
//2-23-19
//Networking Milestone
//This is my own work.
//interacts with the database and the addresses data

//this class is not in use yet

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
            $stmt = $this->conn->prepare("INSERT INTO `ADDRESSES` (`STREET_ADDRESS`, `CITY`, `STATE`, `ZIP_CODE`) VALUES (:street_address, :city, :state, :zip_code))");
            
            //Store the information from the addresses object into variables
            $str_ad = $addy->getStreet_address(); 
            $city = $addy->getCity(); 
            $state = $addy->getState(); 
            $zip = $addy->getZip_code(); 
            
            //Bind the variables from the addresses object to the SQL statement
            $stmt->bindParam(':street_address', $str_ad);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':zip_code', $zip);
            
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
            $stmt = $this->conn->prepare("SELECT * FROM ADDRESSES WHERE `ID` = :id");
            
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
                $str_ad = $addy['STREET_ADDRESS'];
                $city = $addy['CITY'];
                $state = $addy['STATE'];
                $zip = $addy['ZIP_CODE']; 
                
                
                //create a new address object with the data from above
                $addy_ob = new AddressesModel($id, $str_ad, $city, $state, $zip);    
    
                Log::info("Exiting AddressesDataService.read() with returning an address object");
                return $addy_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
}