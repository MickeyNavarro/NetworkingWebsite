<?php
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//interacts with the database and the skills class data

namespace App\Services\DataServices; 

use App\Models\SkillsModel;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 

class SkillsDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
   
    // accepts a skills object; Inserts a record into the skills table
    function create(SkillsModel $skill){
            Log::info("Entering SkillsDataService.create()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `SKILLS` (`SKILLS_NAME`, `USERS_ID`) VALUES (:skill, :userid)");
            
            //Store the information from the skills object into variables
            $skills_name = $skill->getSkills_name(); 
            $userid = $skill->getUserid(); 
            
            //Bind the variables from the skills object to the SQL statement
            $stmt->bindParam(':skill', $skills_name);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting SkillsDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting SkillsDataService.create()with false");
                return false;
            }

    }
    
    //accepts an user id; finds the user skills in the database with a matching id
    function readByUserID($id){
        try {
            Log::info("Entering SkillsDataService.readByUserID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `SKILLS` WHERE USERS_ID = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting SkillsDataService.readByUserID() with returning null");
                return null;
            }
            else{
                //create an skills array
                $skill_array = array();
                
                //loop to get all the skill data to put into the array
                while ($skill = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($skill_array, $skill);
                    
                }
                              
                Log::info("Exiting SkillsDataService.readByUserID() with returning a skill object");
                return $skill_array;            
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts an skills id; finds the user skills in the database with a matching id
    function readBySkillID($id){
        try {
            Log::info("Entering SkillsDataService.readBySkillID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `SKILLS` WHERE `ID` = :id LIMIT 1");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting SkillsDataService.readBySkillID() with returning null");
                return null;
            }
            else{
                //fetch all the data
                $skill = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the data
                $skill_name = $skill['SKILLS_NAME']; 
                $userid = $skill['USERS_ID']; 
                
                //create a new instance of an skills model
                $skill_ob = new SkillsModel($id, $skill_name, $userid); 
                
                Log::info("Exiting SkillsDataService.readBySkillID() with returning a skills object");
                return $skill_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts a skills model; updates the skills model in the database based on id
    function update(SkillsModel $skill) {
        try {
            Log::info("Entering SkillsDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `SKILLS` SET `SKILLS_NAME`= :skills_name WHERE `ID`=:id");
            
            //Store the information from the skills object into variables
            $skills_name = $skill->getSkills_name(); 
            $id = $skill->getId(); 
            
            //Bind the variables from the education object to the SQL statement
            $stmt->bindParam(':skills_name', $skills_name);
            $stmt->bindParam(':id', $id);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting SkillsDataService.update() with true");
                return true;
            }
            else {
                Log::info("Exiting SkillsDataService.update()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the skills in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering SkillsDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `SKILLS` WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting SkillsDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting SkillsDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}