<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//interacts with the database and the personal information data

namespace App\Services\DataServices; 

use App\Models\PersonalInformationModel;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 

class PersonalInformationDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a personal information object; Inserts a record into the personalinformation table
    function create(PersonalInformationModel $pi){
        try {
            Log::info("Entering PersonalInformationDataService.create()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `PERSONAL_INFORMATION` (`BIOGRAPHY`, `CURRENT_POSITION`, `CONTACT_EMAIL`, `PHONE_NUMBER`, `PHOTO`, `USERS_ID`) VALUES (:biography, :currposition, :contactemail, :phone, :photo, :userid)");

            //Store the information from the personal information object into variables
            $bio = $pi->getBiography(); 
            $pos = $pi->getCurrent_position(); 
            $email = $pi->getContact_email(); 
            $phone = $pi->getPhone_number(); 
            $photo = $pi->getPhoto(); 
            $userid = $pi->getUserid(); 
            
            //Bind the variables from the personal information object to the SQL statement
            $stmt->bindParam(':biography', $bio);
            $stmt->bindParam(':currposition', $pos); 
            $stmt->bindParam(':contactemail', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting PersonalInformationDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting PersonalInformationDataService.create()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    //accepts an user id; finds the user personal info in the database with a matching id
    function readByUserID($id){
        try {
            Log::info("Entering PersonalInformationDataService.read()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `PERSONAL_INFORMATION` WHERE USERS_ID = :id");
            
            //Bind the variables from the user object to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting PersonalInformationDataService.read() with returning null");
                return null;
            }
            else{
                
                //fetch all the personal information data
                $pi = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the personal info  data
                $pi_id = $pi['ID'];
                $biography = $pi['BIOGRAPHY'];
                $current_position = $pi['CURRENT_POSITION']; 
                $contact_email = $pi['CONTACT_EMAIL'];
                $phone_number = $pi['PHONE_NUMBER'];
                $photo = $pi['PHOTO'];
                
                //create a new personal information object with the data from above
                $pi_ob = new PersonalInformationModel($pi_id, $biography, $current_position, $contact_email, $phone_number, $photo, $id); 
                
                Log::info("Exiting PersonalInformationDataService.read() with returning a personal information object");
                return $pi_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts a personal info id; finds the user personal info in the database with a matching id
    function readByPersonalInfoID($id){
        try {
            Log::info("Entering PersonalInformationDataService.readByPersonalInfoID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `PERSONAL_INFORMATION` WHERE `ID` = :id LIMIT 1");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting PersonalInformationDataService.readByPersonalInfoID() with returning null");
                return null;
            }
            else{
                //fetch all the personal information data
                $pi = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the personal info  data
                $biography = $pi['BIOGRAPHY'];
                $current_position = $pi['CURRENT_POSITION'];
                $contact_email = $pi['CONTACT_EMAIL'];
                $phone_number = $pi['PHONE_NUMBER'];
                $photo = $pi['PHOTO'];
                $userid = $pi['USERS_ID'];
                
                //create a new personal information object with the data from above
                $pi_ob = new PersonalInformationModel($id, $biography, $current_position, $contact_email, $phone_number, $photo, $userid);                 
                

                Log::info("Exiting PersonalInformationDataService.readByPersonalInfoID() with returning a personal info object");
                return $pi_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts a personal info model; updates the personal info model in the database based on id
    function update(PersonalInformationModel $pi) {
        /* try { */
            Log::info("Entering PersonalInformationDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `PERSONAL_INFORMATION` SET `BIOGRAPHY`= :bio,`CURRENT_POSITION`= :pos,`CONTACT_EMAIL`= :email,`PHONE_NUMBER`= :phone,`PHOTO`= :photo WHERE `ID`=:id");
            
            //Store the information from the personal info object into variables
            $bio = $pi->getBiography(); 
            $pos = $pi->getCurrent_position(); 
            $email = $pi->getContact_email(); 
            $phone = $pi->getPhone_number(); 
            $photo = $pi->getPhoto(); 
            $id = $pi->getId();
            
            //Bind the variables from the personal info object to the SQL statement
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':pos', $pos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':id', $id);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting PersonalInformationDataService.update() with true");
                return true;
            }
            else {
                Log::info("Exiting PersonalInformationDataService.update()with false");
                return false;
            }
            
        /* }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        } */
    }
        
        
    
    
    //accepts the id; deletes the personal info in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering PersonalInformationDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `PERSONAL_INFORMATION` WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting PersonalInformationDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting PersonalInformationDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}