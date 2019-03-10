<?php
//Almicke Navarro
//2-27-19
//Networking Milestone
//This is my own work.
//interacts with the database and the users groups class data

namespace App\Services\DataServices; 

use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 
use App\Models\UsersGroupsModel;

class UsersGroupsDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
   
    // accepts a users groups object; Inserts a record into the users groups table
    function create(UsersGroupsModel $ug){
            Log::info("Entering UsersGroupsDataService.create()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `USERS_GROUPS` (`USERS_ID`, `GROUPS_ID`) VALUES (:userid, :groupid)");
            
            //Store the information from the users groups object into variables
            $userid = $ug->getUser_id(); 
            $groupid = $ug->getGroups_id(); 
            
            //Bind the variables from the users groups object to the SQL statement
            $stmt->bindParam(':userid', $userid);
            $stmt->bindParam(':groupid', $groupid); 
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting UsersGroupsDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting UsersGroupsDataService.create()with false");
                return false;
            }

    }
    
    //accepts a group id; finds the group with all its data, especially its users, in the database with a matching id
    function readByGroupID($id){
        try {
            Log::info("Entering UsersGroupsDataService.readByGroupID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT `USERS_GROUPS`.`ID`, `GROUPS_ID`, `GROUPS`.`GROUP_NAME`, `GROUPS`.`DESCRIPTION`, `USERS`.`USERNAME` FROM `USERS_GROUPS` JOIN `USERS` ON `USERS_GROUPS`.`USERS_ID` = `USERS`.`ID` JOIN `GROUPS` ON `USERS_GROUPS`.`GROUPS_ID` = `GROUPS`.`ID` WHERE `GROUPS_ID` = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UsersGroupsDataService.readByGroupID() with returning null");
                return null;
            }
            else{
                //create an user groups array
                $ug_arr = array();
                
                //loop to get all the users groups data to put into the array
                while ($ug = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($ug_arr, $ug);
                }
                                
                Log::info("Exiting UsersGroupsDataService.readByGroupID() with returning all the groups that the user belongs to");
                return $ug_arr;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts an user id term; finds the groups a user belongs to in the database
    function readByUserId($id){
        try {
            Log::info("Entering UsersGroupsDataService.readByUserId()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT `USERS_GROUPS`.`ID`,`USERS_ID`,`GROUPS_ID`, `GROUPS`.`GROUP_NAME`, `GROUPS`.`DESCRIPTION` FROM `GROUPS` JOIN `USERS_GROUPS` ON `USERS_GROUPS`.`GROUPS_ID` = `GROUPS`.`ID` WHERE USERS_ID = :id ");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UsersGroupsDataService.readByUserId() with returning null");
                return null;
            }
            else{
                //create an user groups array
                $ug_arr = array();
                
                //loop to get all the users groups data to put into the array
                while ($ug = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($ug_arr, $ug);
                }
                
                Log::info("Exiting UsersGroupsDataService.readByUserId() with returning an array of groups");
                return $ug_arr;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the user groups in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering SkillsDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `USERS_GROUPS` WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting UsersGroupsDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting UsersGroupsDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}