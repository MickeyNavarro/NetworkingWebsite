<?php
//Almicke Navarro
//2-22-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to outputting the user profile

//this controller is no longer in use due to the UserRestController
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Services\Utility\ILoggerService;


class UserProfileController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to return all the user data needed on the profile page
    public function index(Request $request){
        
        try{
            //get the user id from the session variable
            $id = session()->get('userid');
            
            //find the personal info data to pass onto the views
            $pbs = new PersonalInformationBusinessService(); 
            
            //find the personal info by the user id 
            $pi = $pbs->readByUserID($id); 
            
            //create a new instance of the EducationBusinessService
            $ebs = new EducationBusinessService(); 
                
            //find the education by the user id
            $edu = $ebs->readByUserID($id);
            
            //create a new instance of the WorkExperienceBusinessService
            $wbs = new WorkExperienceBusinessService(); 
            
            //find the work experience by the user id 
            $work = $wbs->readByUserID($id); 
            
            //create a new instance of the SkillsBusinessService
            $sbs = new SkillsBusinessService(); 
            
            //find the skill by the user id
            $skills = $sbs->readByUserID($id); 
            
            //create a new instance of the UserBusinessService
            $ubs = new UserBusinessService(); 
            
            //find the user object by its id
            $user = $ubs->readByUserId($id); 
            
            //find the user's first and last name
            $firstname = $user->getFirstName(); 
            $lastname = $user->getLastname(); 
            
            //Create a new business service
            $ugbs = new UsersGroupsBusinessService();
            
            //create a variable to hold the user groups stuff
            $usergroups = $ugbs->readByUserID($id);
            
            //create new jobs business services 
            $ujbs = new UsersJobPostingsBusinessService(); 
            
            //create variables to hold the saved and applied jobs
            $savedjobs = $ujbs->readSaved($id); 
            $appliedjobs = $ujbs->readApplied($id);
                       
            //compress all the user data into a single array
            $Data = [
                'pi' => $pi,
                'edu' => $edu, 
                'work' => $work, 
                'skills' => $skills, 
                'firstname' => $firstname, 
                'lastname' => $lastname, 
                'usergroups' => $usergroups, 
                'savedjobs' => $savedjobs, 
                'appliedjobs' => $appliedjobs
            ];
            
            //Render a response view of the user profile and pass on the array of user profile data
            return view('userProfileView')->with($Data);
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}
