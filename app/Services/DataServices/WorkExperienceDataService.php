<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//interacts with the database and the work experience class data

namespace App\Services\DataServices; 

use App\Models\WorkExperienceModel;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 

class WorkExperienceDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a work experience object; inserts a record into the work experience table
    function create(WorkExperienceModel $work){
        try{
            Log::info("Entering WorkExperienceDataService.createNewWorkExperience()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `WORK_EXPERIENCE` (`POSITION`, `COMPANY`, `START_YEAR`, `END_YEAR`, `ADDITIONAL_INFORMATION`, `USERS_ID`) VALUES (:pos, :com, :start, :end, :info, :userid)");
            
            //Store the information from the work experience object into variables
            $position = $work->getPosition(); 
            $company = $work->getCompany(); 
            $start = $work->getStart_year(); 
            $end = $work->getEnd_year(); 
            $info = $work->getAdditional_info(); 
            $userid = $work->getUserid(); 
            
            //Bind the variables from the work experience object to the SQL statement
            $stmt->bindParam(':pos', $position);
            $stmt->bindParam(':com', $company);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':info', $info);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting WorkExperienceDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting WorkExperienceDataService.create()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts an user id; finds the user work experience in the database with a matching id
    function readByUserID($id){
        try {
            Log::info("Entering WorkExperienceDataService.readByUserID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `WORK_EXPERIENCE` WHERE USERS_ID = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting WorkExperienceDataService.readByUserID() with returning null");
                return null;
            }
            else{
                //create work experience array
                $work_array = array();
                
                //loop to get all the work experience data to put into the array
                while ($work = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($work_array, $work);
                    
                }
                
                Log::info("Exiting WorkExperienceDataService.readByUserID() with returning a work experience array");
                return $work_array;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    } 
    
    //accepts an work experience id; finds the user work experience in the database with a matching id
    function readByWorkID($id){
        try {
            Log::info("Entering WorkExperienceDataService.readByWorkID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `WORK_EXPERIENCE` WHERE `ID` = :id LIMIT 1");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting WorkExperienceDataService.readByWorkID() with returning null");
                return null;
            }
            else{
                //fetch all the work experience data
                $work = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the user data
                $position = $work['POSITION']; 
                $company = $work['COMPANY']; 
                $start_year = $work['START_YEAR']; 
                $end_year = $work['END_YEAR']; 
                $additional_info = $work['ADDITIONAL_INFORMATION'];
                $userid = $work['USERS_ID']; 
                
                //create a new instance of a work experience model
                $work_ob = new WorkExperienceModel($id, $position, $company, $start_year, $end_year, $additional_info, $userid); 
                
                Log::info("Exiting WorkExperienceDataService.readByWorkID() with returning a work experience object");
                return $work_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts a work experience model; updates the work experience model in the database based on id
    function update(WorkExperienceModel $work) {
        try {
            Log::info("Entering WorkExperienceDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `WORK_EXPERIENCE` SET `POSITION`= :position ,`COMPANY`= :company,`START_YEAR`= :start,`END_YEAR`= :end,`ADDITIONAL_INFORMATION`= :info WHERE `ID`= :id");
            
            //Store the information from the work experience object into variables
            $pos = $work->getPosition(); 
            $com = $work->getCompany(); 
            $start = $work->getStart_year(); 
            $end = $work->getEnd_year(); 
            $info = $work->getAdditional_info(); 
            $id = $work->getId(); 
            
            //Bind the variables from the work experience object to the SQL statement
            $stmt->bindParam(':position', $pos);
            $stmt->bindParam(':company', $com);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':info', $info);
            $stmt->bindParam(':id', $id);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting WorkExperienceDataService.update() with true");
                return true;
            }
            else {
                Log::info("Exiting WorkExperienceDataService.update()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the work experience in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering WorkExperienceDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `WORK_EXPERIENCE` WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting WorkExperienceDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting WorkExperienceDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}