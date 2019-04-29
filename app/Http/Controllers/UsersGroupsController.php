<?php
//Almicke Navarro
//3-2-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to user groups
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\UsersGroupsModel;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\BusinessServices\GroupsBusinessService;

class UsersGroupsController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of a user joining a group
    public function create(Request $request){
        
        try{
            $this->logger->info("Entering UsersGroupsController.create()");
            
            //Store the form data
            $groups_id = $request->input('id');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ugbs = new UsersGroupsBusinessService();
            
            //Create a new users groups object with the form data
            $usergroup = new UsersGroupsModel(0, $userid, $groups_id); 
            
            //Use the business service object to create a new user group in the database
            if($ugbs->create($usergroup)){
                
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with joining this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersGroupsController.create() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show all the users that belong to a single group
    public function readByGroupId(Request $request){
        
        try{
            $this->logger->info("Entering UsersGroupsController.readByGroupId()");
            
            //Store the form data
            $groups_id = $request->input('id');
            
            //Create new business services
            $ugbs = new UsersGroupsBusinessService();
            $gbs = new GroupsBusinessService(); 
            
            //create a variable to hold the user groups stuff
            $groupusers = $ugbs->readByGroupID($groups_id); 
            $groupdata = $gbs->readByGroupId($groups_id);
            
                        
            //check if the the business service object returned an user groups object
            if($groupdata !=null){

                //compress all the user data into a single array
                $data = ['groupdata' => $groupdata, 'groupusers' => $groupusers];
                
                //compress the user groups array to be sent to the view
                return view('groupView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with showing this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersGroupsController.readByGroupId() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    } 
    
    //accepts the request from the web browser to show all the groups a user is in by their id 
    public function readByUserId(Request $request){
        
        try{
            $this->logger->info("Entering UsersGroupsController.readByUserId()");
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ugbs = new UsersGroupsBusinessService();
            
            //create a variable to hold the user groups stuff
            $usergroups = $ugbs->readByUserID($userid);
            
            //check if the the business service object returned an user groups object
            if($usergroups !=null){
                
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry, there were no groups found.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersGroupsController.readByUserId() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    } 
    
    //accepts the request from the web browser to delete an existing record of a user within a group (basically the user leaves the group)
    public function delete(Request $request){
        try{
            $this->logger->info("Entering UsersGroupsController.delete()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ugbs = new UsersGroupsBusinessService();
            
            //Use the business service object to delete the record of user  in the database
            if($ugbs->delete($id)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with leaving this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersGroupsController.delete() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //finds the user profile info
    private function getUserProfileData() {
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
        return $Data;
    }
    
}
