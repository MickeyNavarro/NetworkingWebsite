<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to education
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\EducationModel;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Services\Utility\ILoggerService;

class EducationController extends Controller
{
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of education
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $school = $request->input('school');
            $degree = $request->input('degree');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $bs = new EducationBusinessService(); 
            
            //Create a new education object with the form data
            $edu = new EducationModel(0, $school, $degree, $start, $end, $info, $userid);
            
            //Use the business service object to create a new education in the database
            if($bs->create($edu)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with adding this record of education.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    //accepts the request from the web browser to show an existing record of education
    public function readByEduID(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new EducationBusinessService();
            
            //create a variable to hold the education stuff 
            $edu = $bs->readByEduID($id); 
            
            //check if the the business service object returned an education object
            if($edu !=null){
                
                //compress the education array to be sent to the view
                $data = ['edu' => $edu]; 
                
                //Render a response View with success message
                return view('updateEducationView')->with($data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with showing this record of education.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    //accepts the request from the web browser to update an existing record of education
    public function update(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id'); 
            $school = $request->input('school');
            $degree = $request->input('degree');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo');
            
            //Create a new business service
            $bs = new EducationBusinessService();
            
            //Create a new education object with the form data
            $edu = new EducationModel($id, $school, $degree, $start, $end, $info, null);
            
            //Use the business service object to update a new education in the database
            if($bs->update($edu)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with updating this record of education.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to delete an existing record of education
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new EducationBusinessService();
            
            //Use the business service object to delete the record of education in the database
            if($bs->delete($id)){
                //compress all the user data into a single array
                $Data = $this->getUserProfileData();
                
                //Render a response view of the user profile and pass on the array of user profile data
                return view('userProfileView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with deleting this record of education.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['school' => 'Required | alpha_spaces','degree' => 'Required | alpha_spaces', 'startYear' => 'Required | Numeric | Between: 1900,2019', 'endYear' => 'Required | Numeric | Between: 1900,2019','additionalInfo' => 'Required'];
        
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
