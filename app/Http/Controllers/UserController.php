<?php
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to users
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\Utility\ILoggerService;
use App\Models\UsersModel;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;

class UserController extends Controller
{
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts a request from the web browser to create a new user
    public function create(Request $request){
        
        try{
            $this->logger->info("Entering UserController.create()");
            
            //validate the form data
            $this->validateRegistrationForm($request);
            
            //Store the form data
            $first = $request->input('firstname');
            $last = $request->input('lastname');
            $email = $request->input('email');
            $username = $request->input('username');
            $password = $request->input('password');
            
            //Create a new business service
            $bs = new UserBusinessService(); 
            
            //Create a new user object with the form data
            $user = new UsersModel(0, $first, $last, $email, $username, $password, 0, 0);
            
            //Use the business service object to create a new user in the database
            if($bs->create($user)){
                //Render a response View with success message
                return view('loginView');
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Login was unsuccessful. Please try again.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }catch (Exception $e){
            $this->logger->error("Leaving UserController.create() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //validates the form and its data for consistency 
    private function validateRegistrationForm(Request $request) {
        //setup data validattion rules
        $rules = ['firstname' => 'Required | Between: 1,20| alpha_spaces ','lastname' => 'Required | Between: 1,20| alpha_spaces_dashes', 'email' => 'Required | email', 'username' => 'Required | Between: 1,20|alpha_spaces','password' => 'Required | Between: 8,20'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
    //accepts a request from the web browser to read a user by their credentials
    public function readByCredentials(Request $request){
        
        try{
            $this->logger->info("Entering UserController.readByCredentials()");
            
            //validate the form data
            $this->validateLoginForm($request);
            
            //Store the form data
            $username = $request->input('username');
            $password = $request->input('password');
            
            //Create a new business service
            $bs = new UserBusinessService(); 
            
            //Create a new user object with the form data
            $user = new UsersModel(null, null, null, null, $username, $password, null, null); 
            
            //Use the business service object to attempt to login a user; returns an id
            $userId = $bs->readByCredentials($user); 
                        
            //check if the user id was returned 
            if($userId != null){
                
                //use the user id to find the user object in which the id belongs to
                $user_ob = $bs->readByUserId($userId);  
                
                //find out if the user has been suspended
                $suspend = $user_ob->getSuspend();
                
                //check if the user was not suspended
                if($suspend != 1) {
                    //get the role of the user object
                    $role = $user_ob->getRole();
                    
                    //set the session variables
                    $request->session()->put('userid', $userId);
                    $request->session()->put('role', $role);  
                    
                    //compress all the user data into a single array
                    $Data = $this->getUserProfileData(); 
                    
                    //Render a response view of the user profile and pass on the array of user profile data
                    return view('userProfileView')->with($Data);
                    
                }
                
            }else{
                
                //Render a response View with unsuccessful message
                $errorMessage = "Registration was unsuccessful. Please try again.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            
            $this->logger->error("Leaving UserController.readByCredentials() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    private function validateLoginForm(Request $request) {
        //setup data validattion rules
        $rules = ['username' => 'Required | Between: 1,20| alpha_dash','password' => 'Required | Between: 8,20'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
    //simply returns all of the users in an array
    public function readAll(){
        
        try{
            
            $this->logger->info("Entering UserController.readAll()");
            
            //Create a new business service
            $bs = new UserBusinessService(); 
            
            //Use the business service object to show all users in the database
            if($users = $bs->readAll()){
                //compress all the users into a single array
                $Data = [ 'users' => $users ];
                
                //Render a response view of the admin page of users and pass on the array of users
                return view('adminPageOfUsersView')->with($Data);
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry, there are no users!";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UserController.readAll() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts a request from the web browser to suspend a user 
    public function suspendById(Request $request){
        
        try{
            
            $this->logger->info("Entering UserController.suspendById()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //check if admin is trying to suspend themselves 
            if ($id != session()->get('userid')) { 
            
                //Use the business service object to suspend a user in the database
                if($bs->suspendById($id)){
                    
                    //Use the business service object to show all users in the database
                    if($users = $bs->readAll()){
                        
                        //compress all the users into a single array
                        $Data = [ 'users' => $users ];
                        
                        //Render a response view of the admin page of users and pass on the array of users
                        return view('adminPageOfUsersView')->with($Data);
                        
                    }
                }else{
                    //Render a response View with unsuccessful message
                    $errorMessage = "User was not successfully suspended.";
                    $Data = [ 'errorMessage' => $errorMessage ];
                    return view('unsuccessfulView')->with($errorMessage);
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "You cannot suspend yourself."; 
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UserController.suspendById() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts a request from the web browser to suspend a user
    public function unsuspendById(Request $request){
        
        try{
            
            $this->logger->info("Entering UserController.unsuspendById()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to suspend a user in the database
            if($bs->unsuspendById($id)){
                //Use the business service object to show all users in the database
                if($users = $bs->readAll()){
                    //compress all the users into a single array
                    $Data = [ 'users' => $users ];
                    
                    //Render a response view of the admin page of users and pass on the array of users
                    return view('adminPageOfUsersView')->with($Data);
                    
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "User was not successfully unsuspended.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UserController.unsuspendById() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts the request from the web browser to delete an existing record of an user
    public function delete(Request $request){
        
        try{
            
            $this->logger->info("Entering UserController.delete()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to delete a user in the database
            if($bs->delete($id)){
                //Use the business service object to suspend a user in the database
                if($bs->suspendById($id)){
                    
                    //Use the business service object to show all users in the database
                    if($users = $bs->readAll()){
                        
                        //compress all the users into a single array
                        $Data = [ 'users' => $users ];
                        
                        //Render a response view of the admin page of users and pass on the array of users
                        return view('adminPageOfUsersView')->with($Data);
                        
                    }
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "User was not successfully deleted.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UserController.delete() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //simply breaks the session variable; logs out the user
    public function logout(Request $request){
        
        try{
            
            $this->logger->info("Entering UserController.logout()");
            
            //destroy the session 
            $request->session()->flush(); 
            $request->session()->save(); 
            
            if(!$request->session()->has('userid') && !$request->session()->has('role')) { 
                
                //Render a response view of the admin page of users and pass on the array of users
                return view('homeView');    
                                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Logout was not successful. Please try again.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving UserController.logout() with Exception Error: ", array("message" => $e->getMessage()));
            
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
