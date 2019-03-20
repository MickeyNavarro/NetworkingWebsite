<?php
//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//interacts with the database and the job postings class data

//references: https://owlcation.com/stem/How-to-search-for-multiple-keywords-and-long-text-in-MySql-Table-using-PHP 

namespace App\Services\DataServices; 

use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;
use \PDO; 
use App\Models\JobPostingsModel;
use function GuzzleHttp\json_encode;

class JobPostingsDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a job postings object; inserts a record into the job postings table
    function create(JobPostingsModel $job){
        try{
            Log::info("Entering JobPostingsDataService.createNewWorkExperience()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `JOB_POSTINGS`(`NAME`, `COMPANY`, `PAY`, `DESCRIPTION`) VALUES (:name ,:com, :pay, :des)");
            
            //Store the information from the job posting object into variables
            $name = $job->getName(); 
            $com = $job->getCompany(); 
            $pay = $job->getPay(); 
            $des = $job->getDescription(); 
            
            //Bind the variables from the job posting object to the SQL statement
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':com', $com);
            $stmt->bindParam(':pay', $pay);
            $stmt->bindParam(':des', $des);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting JobPostingsDataService.create() with true");
                return true;
            }
            else {
                Log::info("Exiting JobPostingsDataService.create()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
        
    //accepts an job posting id; finds the job posting in the database with a matching id
    function readByJobID($id){
        try {
            Log::info("Entering JobPostingsDataService.readByJobID()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `JOB_POSTINGS` WHERE `ID` = :id LIMIT 1");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is a row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting JobPostingsDataService.readByJobID() with returning null");
                return null;
            }
            else{
                //fetch all the job posting data
                $job = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //create variables to hold the user data
                $name = $job['NAME']; 
                $company = $job['COMPANY']; 
                $pay = $job['PAY']; 
                $description = $job['DESCRIPTION']; 
                
                //create a new instance of an job postings model
                $job_ob = new JobPostingsModel($id, $name, $company, $pay, $description); 
                
                Log::info("Exiting JobPostingsDataService.readByJobID() with returning a job postings object");
                return $job_ob;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //allows the admin to view all job postings
    function readAll(){
        try{
            Log::info("Entering JobPostingsDataService.readAll()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("SELECT * FROM `JOB_POSTINGS`");
            
            //execute the SQL statement
            $stmt->execute();
            
            //check is any row was returned
            if($stmt->rowCount() == 0){
                Log::info("Exiting JobPostingsDataService.readAll() with returning null");
                return null;
            }
            else{
                //create an jobs array
                $jobs_array = array();
                
                //loop to get all the user data to put into the array
                while ($jobs = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($jobs_array, $jobs);
                    
                }
                
                Log::info("Exiting JobPostingsDataService.readAll() with an array of users");
                return $jobs_array;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //allows the user to view all job postings that they are matched to 
    function readMatches($id){
        try{
            Log::info("Entering JobPostingsDataService.readMatches()");
            
            //use the connection to create a prepared statement
            $skill_stmt = $this->conn->prepare("SELECT `SKILLS`.`SKILLS_NAME` FROM `USERS` JOIN `SKILLS` ON `SKILLS`.`USERS_ID` = `USERS`.`ID` WHERE `USERS`.`ID` = :id");
            /* $degree_stmt = $this->conn->prepare("SELECT `EDUCATION`.`DEGREE` FROM `USERS` JOIN `EDUCATION` ON `EDUCATION`.`USERS_ID` = `USERS`.`ID` WHERE `USERS`.`ID` = :id"); 
            $pi_stmt = $this->conn->prepare("SELECT `PERSONAL_INFORMATION`.`BIOGRAPHY`, `PERSONAL_INFORMATION`.`CURRENT_POSITION` FROM `USERS` JOIN `PERSONAL_INFORMATION` ON `PERSONAL_INFORMATION`.`USERS_ID` = `USERS`.`ID` WHERE `USERS`.`ID` = :id"); 
            $work_stmt = $this->conn->prepare("SELECT `WORK_EXPERIENCE`.`POSITION`, `WORK_EXPERIENCE`.`COMPANY` FROM `USERS` JOIN `WORK_EXPERIENCE` ON `WORK_EXPERIENCE`.`USERS_ID` = `USERS`.`ID` WHERE `USERS`.`ID` = :id");  */
            
            //Bind the variables to the SQL statement
            $skill_stmt->bindParam(':id', $id);
            /* degree_stmt->bindParam(':id', $id);
            $pi_stmt->bindParam(':id', $id);
            $work_stmt->bindParam(':id', $id); */
            
            //execute the SQL statement
            $skill_stmt->execute(); 
            /* $degree_stmt->execute(); 
            $pi_stmt->execute(); 
            $work_stmt->execute();  */
        
            //create an keyword array
            $keywords_arr = array();
             
            /* //loop to get all the degree to put into the keywords array
            if ($degree_stmt->rowCount() != 0){
                while ($degree = $degree_stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($keywords_arr, $degree);
                }
            } */
            
            //loop to get all the skills to put into the keywords array
            if ($skill_stmt->rowCount() != 0){ 
                while ($skill = $skill_stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($keywords_arr, $skill);
                }
            }
                      
            //compare the user data to each job posting 
            $query = "SELECT * FROM `JOB_POSTINGS` WHERE `NAME` LIKE '%" . $keywords_arr[0]['SKILLS_NAME'] . "%' OR `DESCRIPTION` LIKE '%".$keywords_arr[0]['SKILLS_NAME']."%'";
            
            for($i = 1; $i < count($keywords_arr); $i++) {
                if(!empty($keywords_arr[$i])) {
                    $query .= " OR `NAME` LIKE '%".$keywords_arr[$i]['SKILLS_NAME']."%' OR `DESCRIPTION` LIKE '%".$keywords_arr[$i]['SKILLS_NAME']."%'";
                }
            }
            
            $job_stmt = $this->conn->prepare($query);
            
            $job_stmt->execute();
            
            //check is any row was returned
            if($job_stmt->rowCount() == 0){
                Log::info("Exiting JobPostingsDataService.readMatches() with returning null");
                return null;
            }
            else{
                //create an jobs array
                $jobs_array = array();
                
                //loop to get all the user data to put into the array
                while ($jobs = $job_stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    array_push($jobs_array, $jobs);
                    
                }
                
                Log::info("Exiting JobPostingsDataService.readMatches() with an array of users");
                return $jobs_array;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    //accepts a job posting model; updates the job postings model in the database based on id
    function update(JobPostingsModel $job) {
        try {
            Log::info("Entering JobPostingsDataService.update()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("UPDATE `JOB_POSTINGS` SET `NAME`= :name ,`COMPANY`= :com,`PAY`= :pay,`DESCRIPTION`= :des WHERE `ID`= :id");
            
            //Store the information from the job posting object into variables
            $name = $job->getName();
            $com = $job->getCompany();
            $pay = $job->getPay();
            $des = $job->getDescription();
            $id = $job->getId(); 
            
            //Bind the variables from the job posting object to the SQL statement
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':com', $com);
            $stmt->bindParam(':pay', $pay);
            $stmt->bindParam(':des', $des);
            $stmt->bindParam(':id', $id); 
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was updated the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting JobPostingsDataService.update() with true");
                return true;
            }
            else {
                Log::info("Exiting JobPostingsDataService.update()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //accepts the id; deletes the job posting in the database with a matching id
    function delete($id){
        try {
            Log::info("Entering JobPostingsDataService.delete()");
            
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("DELETE FROM `JOB_POSTINGS` WHERE `ID` = :id");
            
            //Bind the variables to the SQL statement
            $stmt->bindParam(':id', $id);
            
            //execute the SQL statement
            $result = $stmt->execute();
            
            //If a row was deleted the method will return true.
            //If not it will return false
            if ($result) {
                Log::info("Exiting JobPostingsDataService.delete() with true");
                return true;
            }
            else {
                Log::info("Exiting JobPostingsDataService.delete()with false");
                return false;
            }
        }
        catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}