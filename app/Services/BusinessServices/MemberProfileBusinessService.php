<?php
namespace App\Services\BusinessServices;

use App\Models\EducationModel;
use App\Models\PersonalInformationModel;
use App\Models\SkillsModel;
use App\Models\WorkExperienceModel;
use App\Services\DataServices\MemberProfileDataService;
use Illuminate\Support\Facades\Log;
use \PDO; 

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
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewPersonalInfo($pi);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewPersonalInformation() with " . $flag);
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
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewEducation($edu);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewEducation() with " . $flag);
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
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewWorkExperience($work);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewWorkExperience() with " . $flag);
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
        
        //Create a Security Service DAO with this connection and try to find the password in User
        $service = new MemberProfileDataService($conn);
        $flag = $service->createNewSkills($skill);
        
        //Return the finder results
        Log::info("Exit MemberProfileBusinessService.createNewSkills() with " . $flag);
        return $flag;
    }
}

