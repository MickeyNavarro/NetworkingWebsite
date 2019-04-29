<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to work experience
namespace App\Http\Controllers;


use App\Models\WorkExperienceModel;
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


class WorkExperienceController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of work experience
    public function create(Request $request){
        
        try{
            $this->logger->info("Entering WorkExperienceController.create()");
            
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $pos = $request->input('position');
            $com = $request->input('company');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo'); 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService(); 
            
            //Create a new work experience object with the form data
            $newWork = new WorkExperienceModel(0, $pos, $com, $start, $end, $info, $userid); 
            
            //check if the creation was a success
            if($wbs->create($newWork)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with creating this record of work experience.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving WorkExperienceController.create() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show an existing record of work experience
    public function readByWorkID(Request $request){
        
        try{
            $this->logger->info("Entering WorkExperienceController.readByWorkID()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService();
            
            //create a variable to hold the work education stuff
            $work = $wbs->readByWorkID($id); 
            
            //check if a work experience was returned
            if($work !=null){
                
                //compress the work experience array to be sent to the view
                $data = ['work' => $work];
                
                //Render a response view 
                return view('updateWorkExperienceView')->with($data);
                
            }else{
                //Render a response view with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with showing this record of work experience.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving WorkExperienceController.readByWorkID() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    //accepts the request from the web browser to update an existing record of work experience
    public function update(Request $request){
        
        try{
            $this->logger->info("Entering WorkExperienceController.update()");
            
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id');
            $pos = $request->input('position');
            $com = $request->input('company');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo'); 
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService();
            
            //Create a new object with the form data
            $work = new WorkExperienceModel($id, $pos, $com, $start, $end, $info, null); 
            
            //check if the method was a success
            if($wbs->update($work)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with updating this record of work experience.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving WorkExperienceController.update() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to delete an existing record of work experience
    public function delete(Request $request){
        try{
            $this->logger->info("Entering WorkExperienceController.delete()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService();
            
            //Use the business service object to delete a work experience in the database
            if($wbs->delete($id)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with deleting this record of work experience.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving WorkExperienceController.delete() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['position' => 'Required','company' => 'Required', 'startYear' => 'Required | Numeric | Between: 1900,2019', 'endYear' => 'Required | Numeric | Between: 1900,2019','additionalInfo' => 'Required'];
        
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
