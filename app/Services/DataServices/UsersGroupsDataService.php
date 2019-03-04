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
    
    //accepts an user id; finds the user groups in the database with a matching id
    function readByUserID($id){
        try {
            Log::info("Entering UsersGroupsDataService.readByUserID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `USERS_GROUPS` WHERE USERS_ID = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting UsersGroupsDataService.readByUserID() with returning null");
                return null;
            }
            else{
                //create an user groups array
                $ug_arr = array();
                
                //loop to get all the users groups data to put into the array
                while ($ug = $stmt->fetch(PDO::FETCH_ASSOC)){                  
                    array_push($ug_arr, $ug);
                }
                
                //create an array of group ids
                $usergroup_ids = array(); 
                
                //loop to get the group ids
                for ($x = 0; $x < count($ug_arr); $x++){
                    $group_id = $ug_arr[$x]['GROUPS_ID'];
                    array_push($usergroup_ids, $group_id);
                }
                              
                Log::info("Exiting UsersGroupsDataService.readByUserID() with returning all the group ids that the user belongs to");
                return $usergroup_ids;            
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the user id; deletes the user groups in the database with a matching id
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