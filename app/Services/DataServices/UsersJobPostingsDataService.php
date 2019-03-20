<?php
//Almicke Navarro
//2-28-19
//Networking Milestone
//This is my own work.
//interacts with the database and the users job postings class data

namespace App\Services\DataServices; 

use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 
use App\Models\UsersJobPostingsModel;

class UsersJobPostingsDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
   
    // accepts a users job postings object; Inserts a record into the users job postings table
    function create(UsersJobPostingsModel $uj){
            Log::info("Entering UsersJobPostingsDataService.create()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `USERS_JOB_POSTINGS` (`SAVE`, `APPLY`, `USERS_ID`, `JOB_POSTINGS_ID`) VALUES (:save, :apply, :userid, :jobid)");
            
            //Store the information from the users job postings object into variables
            $save = $uj->getSave(); 
            $apply = $uj->getApply(); 
            $userid = $uj->getUsers_id(); 
            $jobid = $uj->getJob_postings_id();
            
            //Bind the variables from the users groups object to the SQL statement
            $stmt->bindParam(':save', $save); 
            $stmt->bindParam(':apply', $apply); 
            $stmt->bindParam(':userid', $userid);
            $stmt->bindParam(':jobid', $jobid); 
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting UsersJobPostingsDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting UsersJobPostingsDataService.create()with false");
                return false;
            }

    }
    
    //accepts an user id; finds the user job postings in the database with a matching id
    function readSaved($id){
        try {
            Log::info("Entering UsersJobPostingsDataService.readSaved()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT `JOB_POSTINGS`.`ID`, `JOB_POSTINGS`.`NAME`, `JOB_POSTINGS`.`COMPANY`, `JOB_POSTINGS`.`PAY`, `JOB_POSTINGS`.`DESCRIPTION` FROM `JOB_POSTINGS` JOIN `USERS_JOB_POSTINGS` ON `JOB_POSTINGS`.`ID` = `USERS_JOB_POSTINGS`.`JOB_POSTINGS_ID` WHERE `USERS_ID` = :id AND `SAVE` = 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UsersJobPostingsDataService.readSaved() with returning null");
                return null;
            }
            else{
                //create an user groups array
                $uj_arr = array();
                
                //loop to get all the users groups data to put into the array
                while ($uj = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($uj_arr, $uj);
                    
                }
                              
                Log::info("Exiting UsersJobPostingsDataService.readSaved() with returning a saved jobs array");
                return $uj_arr;            
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts an user id; finds the user job postings in the database with a matching id
    function readApplied($id){
        try {
            Log::info("Entering UsersJobPostingsDataService.readApplied()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT `JOB_POSTINGS`.`ID`, `JOB_POSTINGS`.`NAME`, `JOB_POSTINGS`.`COMPANY`, `JOB_POSTINGS`.`PAY`, `JOB_POSTINGS`.`DESCRIPTION` FROM `JOB_POSTINGS` JOIN `USERS_JOB_POSTINGS` ON `JOB_POSTINGS`.`ID` = `USERS_JOB_POSTINGS`.`JOB_POSTINGS_ID` WHERE USERS_ID = :id AND `APPLY` = 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UsersJobPostingsDataService.readApplied() with returning null");
                return null;
            }
            else{
                //create an user groups array
                $uj_arr = array();
                
                //loop to get all the users groups data to put into the array
                while ($uj = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($uj_arr, $uj);
                    
                }
                
                Log::info("Exiting UsersJobPostingsDataService.readApplied() with returning a applied to jobs array");
                return $uj_arr;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the user id; deletes the user job postings in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering UsersJobPostingsDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `USERS_JOB_POSTINGS` WHERE `JOB_POSTINGS_ID` = :id AND `SAVE` = 1");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting UsersJobPostingsDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting UsersJobPostingsDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}