<?php

//Almicke Navarro
//2-4-19
//Networking Milestone
//This is my own work.
//interacts with the database and the multiple member profile class data

namespace App\Services\BusinessServices;

use App\Models\EducationModel;
use App\Models\PersonalInformationModel;
use App\Models\SkillsModel;
use App\Models\WorkExperienceModel;
use App\Services\DataServices\MemberProfileDataService;
use Illuminate\Support\Facades\Log;
use \PDO; 
use function GuzzleHttp\json_encode;

class MemberProfileBusinessService
{
    // accepts a personalinformation object. Inserts a record into the personalinformation table
    function createNewPersonalInformation(PersonalInformationModel $pi){
        Log::info("Entering MemberProfileBusinessService.createNewPersonalInformation()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection
        $service = new MemberProfileDataService($conn);
        
        //get the user id 
        $userid = $pi->getUserid(); 
        
        //check if there is already personal information stored under the user id
        if ($service->findPersonalInfo($userid) == null) { 
            //create a new personal information
            $flag = $service->createNewPersonalInfo($pi);
            
            //Return the finder results
            Log::info("Exit MemberProfileBusinessService.createNewPersonalInformation() with " . $flag);
            return $flag;
        }
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewPersonalInformation() with null");
        return null;
        
        
    }
    // accepts a personal information object. Inserts a record into the personal information table
    function findPersonalInfo($id){
        Log::info("Entering MemberProfileBusinessService.findPersonalInfo()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection
        $service = new MemberProfileDataService($conn);
        
        //get the personal inforamtion from the database 
        $flag = $service->findPersonalInfo($id);         
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.findPersonalInfo() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a education object. Inserts a record into the education table
    function createNewEducation(EducationModel $edu){
        Log::info("Entering MemberProfileBusinessService.createNewEducation()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection 
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewEducation($edu);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewEducation() with " . $flag);
        return $flag;
    }
    
    // accepts a education object. Inserts a record into the education table
    function findEducation($id){
        Log::info("Entering MemberProfileBusinessService.findEducation()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection
        $service = new MemberProfileDataService($conn);
        $flag = $service->findEducation($id); 
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.findEducation() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a work experience object. Inserts a record into the work experience table
    function createNewWorkExperience(WorkExperienceModel $work){
        Log::info("Entering MemberProfileBusinessService.createNewWorkExperience()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection 
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewWorkExperience($work);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewWorkExperience() with " . $flag);
        return $flag;
    }
    // accepts a skill object. Inserts a record into the skill table
    function findWork($id){
        Log::info("Entering MemberProfileBusinessService.findWork()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection 
        $service = new MemberProfileDataService($conn);
        $flag = $service->findWork($id);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.findWork() with " . json_encode($flag));
        return $flag;
    }
    
    // accepts a skill object. Inserts a record into the skill table
    function createNewSkills(SkillsModel $skill){
        Log::info("Entering MemberProfileBusinessService.createNewSkills()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection 
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewSkills($skill);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewSkills() with " . $flag);
        return $flag;
    }
    
    // accepts a skill object. Inserts a record into the skill table
    function findSkill($id){
        Log::info("Entering MemberProfileBusinessService.findSkill()");
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection 
        $service = new MemberProfileDataService($conn);
        $flag = $service->findSkill($id); 
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.findSkill() with " . json_encode($flag));
        return $flag;
    }
}

