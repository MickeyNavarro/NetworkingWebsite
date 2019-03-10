<?php
//Almicke Navarro
//2-26-19
//Networking Milestone
//This is my own work.
//interacts with the database and the groups class data

namespace App\Services\DataServices; 

use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 
use App\Models\GroupsModel;

class GroupsDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
   
    // accepts a groups object; Inserts a record into the groups table
    function create(GroupsModel $group){
            Log::info("Entering GroupsDataService.create()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `GROUPS` (`ID`, `GROUP_NAME`, `DESCRIPTION`) VALUES (:id, :name, :des)");
            
            //Store the information from the groups object into variables
            $id = $group->getId(); 
            $name = $group->getGroup_name(); 
            $des =  $group->getDescription(); 
            
            //Bind the variables from the groups object to the SQL statement
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':des', $des); 
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting GroupsDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting GroupsDataService.create()with false");
                return false;
            }

    }
    
    //accepts a group id term; finds the group in the database with a matching id
    function readByGroupId($id){
        try {
            Log::info("Entering GroupsDataService.readByGroupId()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `GROUPS` WHERE `ID` = :id LIMIT 1");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting GroupsDataService.readByGroupId() with returning null");
                return null;
            }
            else{
                //fetch all the data
                $group = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the data
                $name = $group['GROUP_NAME']; 
                $des = $group['DESCRIPTION']; 
                
                //create a new instance of a groups model
                $group_ob = new GroupsModel($id, $name, $des); 
                
                Log::info("Exiting GroupsDataService.readByGroupId() with returning a groups object");
                return $group_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    
    //allows the admin to view all groups
    function readAll(){
        try{
            Log::info("Entering GroupsDataService.readAll()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `GROUPS`");
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is any row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting GroupsDataService.readAll() with returning null");
                return null;
            }
            else{
                //create an jobs array
                $groups_array = array();
                
                //loop to get all the user data to put into the array
                while ($groups = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($groups_array, $groups);
                    
                }
                
                Log::info("Exiting GroupsDataService.readAll() with an array of users");
                return $groups_array;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts a group model; updates the group model in the database
    function update(GroupsModel $group) {
        try {
            Log::info("Entering GroupsDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `GROUPS` SET `GROUP_NAME`= :name, `DESCRIPTION` = :des WHERE `ID`=:id");
            
            //Store the information from the group object into variables
            $name = $group->getGroup_name(); 
            $id = $group->getId(); 
            $des = $group->getDescription(); 
            
            //Bind the variables from the group object to the SQL statement
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':des', $des); 
            $stmt->bindParam(':id', $id);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting GroupsDataService.update() with true");
                return true;
            }
            else {
                Log::info("Exiting GroupsDataService.update()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the group in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering GroupsDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `GROUPS`  WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting GroupsDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting GroupsDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}