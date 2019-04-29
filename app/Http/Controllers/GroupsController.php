<?php
//Almicke Navarro
//2-28-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to groups
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Services\Utility\ILoggerService;
use App\Models\GroupsModel;
use App\Services\BusinessServices\GroupsBusinessService;

class GroupsController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of group
    public function create(Request $request){
        
        try{
            $this->logger->info("Entering GroupsController.create()");
            
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $name = $request->input('name');
            $des = $request->input('description'); 
            
            //Create a new business service
            $gbs = new GroupsBusinessService(); 
            
            //Create a new groups object with the form data
            $group = new GroupsModel(0, $name, $des); 
            
            //Use the business service object to create a new group in the database
            if($gbs->create($group)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with creating this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving GroupsController.create() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show an existing record of group
    public function readByGroupId(Request $request){
        
        try{
            $this->logger->info("Entering GroupsController.readByGroupId()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //create a variable to hold the groups stuff
            $group = $gbs->readByGroupId($id); 
            
            //check if the the business service object returned an groups object
            if($group !=null){
                
                //compress the group array to be sent to the view
                $data = ['group' => $group];
                
                //Render a response View with success message
                return view('updateGroupsView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with showing this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving GroupsController.readByGroupId() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show all groups
    public function readAll(Request $request){
        
        try{            
            $this->logger->info("Entering GroupsController.readAll()");
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //create a variable to hold the groups stuff
            $groups = $gbs->readAll(); 
            
            //check if the the business service object returned an groups object
            if($groups !=null){
                
                //compress the group array to be sent to the view
                $data = ['groups' => $groups];
                
                //Render a response View with success message
                return view('adminPageOfGroupsView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry, there are no groups!";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving GroupsController.readAll() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show all groups
    public function userReadAll(Request $request){
        
        try{
            $this->logger->info("Entering GroupsController.userReadAll()");
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //create a variable to hold the groups stuff
            $groups = $gbs->readAll();
            
            //check if the the business service object returned an groups object
            if($groups !=null){
                
                //compress the group array to be sent to the view
                $data = ['groups' => $groups];
                
                //Render a response View with success message
                return view('groupsView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry, there are no groups!";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving GroupsController.userReadAll() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to update an existing record of group
    public function update(Request $request){
        
        try{
            $this->logger->info("Entering GroupsController.update()");
            
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id');
            $group_name = $request->input('name');
            $des = $request->input('description');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //Create a new group object with the form data
            $group = new GroupsModel($id, $group_name, $des);
            
            //Use the business service object to update a new skill in the database
            if($gbs->update($group)){
                //create a variable to hold the groups stuff
                $groups = $gbs->readAll();
                
                //check if the the business service object returned an groups object
                if($groups !=null){
                    
                    //compress the group array to be sent to the view
                    $data = ['groups' => $groups];
                    
                    //Render a response View with success message
                    return view('adminPageOfGroupsView')->with($data);
                    
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with updating this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving GroupsController.update() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to delete an existing record of group
    public function delete(Request $request){
        try{
            $this->logger->info("Entering GroupsController.delete()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //Use the business service object to delete the record of group in the database
            if($gbs->delete($id)){
                //create a variable to hold the groups stuff
                $groups = $gbs->readAll();
                
                //check if the the business service object returned an groups object
                if($groups !=null){
                    
                    //compress the group array to be sent to the view
                    $data = ['groups' => $groups];
                    
                    //Render a response View with success message
                    return view('adminPageOfGroupsView')->with($data);
                    
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with deleting this group.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving GroupsController.delete() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['name' => 'Required | Between: 1,40'];
        
        //run data validation rules
        $this->validate($request, $rules);
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
