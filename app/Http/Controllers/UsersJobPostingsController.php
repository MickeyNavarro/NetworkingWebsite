<?php
//Almicke Navarro
//3-1-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to user job postings
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
use App\Models\UsersJobPostingsModel;

class UsersJobPostingsController extends Controller
{
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of user job postings by saving a job post
    public function save(Request $request){
        
        try{            
            $this->logger->info("Entering UsersJobPostingsController.save()");
            
            //Store the form data
            $job_postings_id = $request->input('id');
            $save = 1; 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService(); 
            
            //Create a new user job postings object with the form data
            $uj = new UsersJobPostingsModel(0, $save, null, $userid, $job_postings_id); 
            
            //Use the business service object to create a new user job postings in the database
            if($ujbs->create($uj)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with saving this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersJobPostingsController.save() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to create a new record of user job postings by applying for a job post
    public function apply(Request $request){
        
        try{        
            $this->logger->info("Entering UsersJobPostingsController.apply()");
            
            //Store the form data
            $job_postings_id = $request->input('id');
            $apply = 1; 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //Create a new user job postings object with the form data
            $uj = new UsersJobPostingsModel(0, null, $apply, $userid, $job_postings_id);
            
            //Use the business service object to create a new user job postings in the database
            if($ujbs->create($uj)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with applying for this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersJobPostingsController.apply() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show an existing record of user's saved job postings
    public function showSaved(Request $request){
        
        try{
            $this->logger->info("Entering UsersJobPostingsController.showSaved()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //create a variable to hold the user job postings stuff
            $savedjobs = $ujbs->readSaved($id);
            
            //check if the the business service object returned an user job postings object
            if($savedjobs !=null){
                
                //compress the group array to be sent to the view
                $data = ['savedjobs' => $savedjobs];
                
                //Render a response View with success message
                return view('userSavedJobsView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry, there were no saved jobs found.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersJobPostingsController.showSaved() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show an existing record of user's saved job postings
    public function showApplied(Request $request){
        
        try{
            $this->logger->info("Entering UsersJobPostingsController.showApplied()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //create a variable to hold the user job postings stuff
            $appliedjobs = $ujbs->readApplied($id); 
            
            //check if the the business service object returned an user job postings object
            if($appliedjobs !=null){
                
                //compress the group array to be sent to the view
                $data = ['appliedjobs' => $appliedjobs];
                
                //Render a response View with success message
                return view('userAppliedJobsView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry, there were no jobs found that the user applied to";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersJobPostingsController.showApplied() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    //accepts the request from the web browser to delete an existing record of user job postings
    public function unsave(Request $request){
        try{
            $this->logger->info("Entering UsersJobPostingsController.unsave()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //Use the business service object to delete the record of user job postings in the database
            if($ujbs->delete($id)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with unsaving this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UsersJobPostingsController.unsave() with Exception Error: ", array("message" => $e->getMessage()));
            
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
