<?php
//Almicke Navarro and Mariah Valenzuela
//2-09-19
//Networking Milestone
//This is my own work.
//interacts with the database and the PersonalInformation class data

namespace App\Services\DataServices; 

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDOException;
use Models\PersonalInformationModel;
use Models\EducationModel;
use Models\WorkExperienceModel;
use Models\SkillsModel;

class MemberProfileDataService{
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // accepts a personalinformation object. Inserts a record into the personalinformation table
    function createNewPersonalInfo(PersonalInformationModel $pi){
        try {
            Log::info("Entering MemberProfileDataService.createNewPersonalInfo()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `PERSONAL_INFORMATION` (`LOCATION`, `BIOGRAPHY`, `CONTACT_EMAIL`, `PHONE_NUMBER`, `PHOTO`, `USERS_ID`) VALUES (:location, :biography, :contactemail, :phone, :photo, :userid)");
            
            //Store the information from the personal information object into variables
            $loc = $pi->getLocation(); 
            $bio = $pi->getBiography(); 
            $email = $pi->getContact_email(); 
            $phone = $pi->getPhone_number(); 
            $photo = $pi->getPhoto(); 
            $userid = $pi->getUserid(); 
            
            //Bind the variables from the personal information object to the SQL statement
            $stmt->bindParam(':location', $loc);
            $stmt->bindParam(':biography', $bio);
            $stmt->bindParam(':contactemail', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting MemberProfileDataService.createNewPersonalInfo() with true");
                return true;
            }
            else {
                Log::info("Exiting MemberProfileDataService.createNewPersonalInfo()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // accepts a education object. Inserts a record into the education table
    function createNewEducation(EducationModel $edu){
        try {
            Log::info("Entering MemberProfileDataService.createNewEducation()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `USERS_EDUCATION` (`SCHOOL`, `DEGREE`, `START_YEAR`, `END_YEAR`, `ADDITIONAL_INFO`, `USERS_ID`) VALUES (:school, :degree, :start, :end, :info, ':userid')");
            
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
                Log::info("Exiting MemberProfileDataService.createNewEducation() with true");
                return true;
            }
            else {
                Log::info("Exiting MemberProfileDataService.createNewEducation()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // accepts a work experience object. Inserts a record into the work experience table
    function createNewWorkExperience(WorkExperienceModel $work){
        try {
            Log::info("Entering MemberProfileDataService.createNewWorkExperience()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `USER_WORK_EXPERIENCE` (`POSITION`, `COMPANY`, `LOCATION`, `START_YEAR`, `END_YEAR`, `ADDITIONAL_INFORMATION`, `USERS_ID`) VALUES (:pos, :com, :loc, :start, :end, :info, ':userid')");
            
            //Store the information from the work experience object into variables
            $position = $work->getPosition(); 
            $company = $work->getCompany(); 
            $location = $work->getLocation(); 
            $start = $work->getStart_year(); 
            $end = $work->getEnd_year(); 
            $info = $work->getAdditional_info(); 
            $userid = $work->getUserid();
            
            //Bind the variables from the work experience object to the SQL statement
            $stmt->bindParam(':pos', $position);
            $stmt->bindParam(':com', $company);
            $stmt->bindParam(':loc', $location); 
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':info', $info);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting MemberProfileDataService.createNewWorkExperience() with true");
                return true;
            }
            else {
                Log::info("Exiting MemberProfileDataService.createNewWorkExperience()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // accepts a skills object. Inserts a record into the skills table
    function createNewSkills(SkillsModel $skill){
        try {
            Log::info("Entering MemberProfileDataService.createNewSkills()");
            //use the connection to create a prepared statement
            $stmt = $this->conn->prepare("INSERT INTO `SKILLS` (`SKILL_NAME`, `USERS_ID`) VALUES (:skill, ':userid')");
            
            //Store the information from the work experience object into variables
            $skill = $skill->getSkill_name(); 
            $userid = $skill->getUserid();
            
            //Bind the variables from the work experience object to the SQL statement
            $stmt->bindParam(':skill', $skill);
            $stmt->bindParam(':userid', $userid);
            
            //Excecute the SQL statement
            $stmt->execute();
            
            //If a row was inserted the method will return true.
            //If not it will return false
            if ($stmt->rowCount() == 1) {
                Log::info("Exiting MemberProfileDataService.createNewSkills() with true");
                return true;
            }
            else {
                Log::info("Exiting MemberProfileDataService.createNewSkills()with false");
                return false;
            }
        }catch (PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}