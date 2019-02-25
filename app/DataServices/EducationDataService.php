<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//interacts with the database and the education class data

namespace App\Services\DataServices; 

use App\Models\EducationModel;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 

class EducationDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a education object; inserts a record into the education table
    function create(EducationModel $edu){
        
            Log::info("Entering EducationDataService.create()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `EDUCATION` (`SCHOOL`, `DEGREE`, `START_YEAR`, `END_YEAR`, `ADDITIONAL_INFORMATION`, `USERS_ID`) VALUES (:school, :degree, :start, :end, :info, :userid)");
            
            //Store the information from the education object into variables
            $school = $edu->getSchool(); 
            $degree = $edu->getDegree(); 
            $start = $edu->getStart_year(); 
            $end = $edu->getEnd_year(); 
            $info = $edu->getAdditional_info(); 
            $userid = $edu->getUserid(); 
            
            //Bind the variables from the education object to the SQL statement
            $stmt->bindParam(':school', $school);
            $stmt->bindParam(':degree', $degree);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':info', $info);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting EducationDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting EducationDataService.create()with false");
                return false;
            }
        
    }
    
    //accepts an user id; finds the user education in the database with a matching id
    function readByUserID($id){
        try {
            Log::info("Entering EducationDataService.readByUserID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `EDUCATION` WHERE USERS_ID = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting EducationDataService.readByUserID() with returning null");
                return null;
            }
            else{
                //create an education array
                $edu_array = array();
                
                //loop to get all the education data to put into the array
                while ($edu = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($edu_array, $edu);
                    
                }
                
                Log::info("Exiting EducationDataService.readByUserID() with returning a education array");
                return $edu_array;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts an education id; finds the user education in the database with a matching id
    function readByEduID($id){
        try {
            Log::info("Entering EducationDataService.readByEduID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `EDUCATION` WHERE `ID` = :id LIMIT 1");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting EducationDataService.readByEduID() with returning null");
                return null;
            }
            else{
                //fetch all the education data
                $edu = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the user data
                $school = $edu['SCHOOL'];
                $degree = $edu['DEGREE']; 
                $start_year = $edu['START_YEAR']; 
                $end_year = $edu['END_YEAR']; 
                $additional_info = $edu['ADDITIONAL_INFORMATION']; 
                
                //create a new instance of an education model 
                $edu_ob = new EducationModel($id, $school, $degree, $start_year, $end_year, $additional_info, null); 
                
                Log::info("Exiting EducationDataService.readByEduID() with returning a education object");
                return $edu_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts an education model; updates the education model in the database based on id 
    function update(EducationModel $edu) { 
        try { 
            Log::info("Entering EducationDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `EDUCATION` SET `SCHOOL`= :school,`DEGREE`= :degree,`START_YEAR`= :start,`END_YEAR`= :end,`ADDITIONAL_INFORMATION`= :info WHERE `ID` = :id");
            
            //Store the information from the education object into variables
            $school = $edu->getSchool();
            $degree = $edu->getDegree();
            $start = $edu->getStart_year();
            $end = $edu->getEnd_year();
            $info = $edu->getAdditional_info();
            $id = $edu->getId();
            
            //Bind the variables from the education object to the SQL statement
            $stmt->bindParam(':school', $school);
            $stmt->bindParam(':degree', $degree);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':info', $info);
            $stmt->bindParam(':id', $id);
            
            //Excecute the SQL statement
            $stmt->execute(); 
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting EducationDataService.update() with true"); 
                return true;
            }
            else {
                Log::info("Exiting EducationDataService.update()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the education in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering EducationDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `EDUCATION` WHERE `EDUCATION`.`ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
                //If not it will return false
            if ($result) {
                Log::info("Exiting EducationDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting EducationDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
}