<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to personal information
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\PersonalInformationModel;
use PHPUnit\Exception;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Services\Utility\ILoggerService;


class PersonalInformationController
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of personal info 
    public function create(Request $request){
        
        try{           
            $this->logger->info("Entering PersonalInformationController.create()");
            
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $photo = $request->input('file');
            $biography = $request->input('bio');
            $current_position = $request->input('pos'); 
            $contact_email = $request->input('email');
            $phone_number = $request->input('phone');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService(); 
            
            //Create a new personal information object with the form data
            $pi = new PersonalInformationModel(0, $biography, $current_position, $contact_email, $phone_number, $photo, $userid); 
            
            //Use the business service object to create a new user in the database
            if($pbs->create($pi)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with creating this record of personal information.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving PersonalInformationController.create() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show an existing record of personal info 
    public function readByPersonalInfoID(Request $request){
        
        try{
            $this->logger->info("Entering PersonalInformationController.readByPersonalInfoID()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService();
            
            //create a variable to hold the personal info 
            $pi = $pbs->readByPersonalInfoID($id); 
            
            //check if a personal info was returned
            if($pi !=null){
                
                //compress the personal info array to be sent to the view
                $data = ['pi' => $pi];
                
                //Render a response view
                return view('updatePersonalInformationView')->with($data);
                
            }else{
                //Render a response view with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with showing this record of personal information.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving PersonalInformationController.readByPersonalInfoID() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    //accepts the request from the web browser to update an existing record of personal info
    public function update(Request $request){
        try{ 
            $this->logger->info("Entering PersonalInformationController.update()");
            
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $photo = $request->input('file');
            $biography = $request->input('bio');
            $current_position = $request->input('pos');
            $contact_email = $request->input('email');
            $phone_number = $request->input('phone');
            $id = $request->input('id');
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService();
            
            //Create a new object with the form data
            $pi = new PersonalInformationModel($id, $biography, $current_position, $contact_email, $phone_number, $photo, null);   
            
            //check if the method was a success
            if($pbs->update($pi)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with updating this record of personal information.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
         }
         catch(ValidationException $e1) {
             throw $e1;
         }
        catch (Exception $e){
            $this->logger->error("Leaving PersonalInformationController.update() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        } 
    }
    
    //accepts the request from the web browser to delete an existing record of personal info
    public function delete(Request $request){
        try{
            $this->logger->info("Entering PersonalInformationController.delete()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService();
            
            //Use the business service object to delete a personal info in the database
            if($pbs->delete($id)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with deleting this record of personal information.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving PersonalInformationController.delete() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['bio' => 'Required','pos' => 'Required | alpha_spaces', 'email' => 'Required | email', 'phone' => 'Required | Numeric | Between: 1,15'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
    //finds the user profile info
    private function getUserProfile() { 
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

