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
use App\Models\UsersModel;

class UserController extends Controller
{
    //accepts a request from the web browser to create a new user
    public function create(Request $request){
        
        try{
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
                return view('unsuccessfulView');
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
    
    //validates the form and its data for consistency 
    private function validateRegistrationForm(Request $request) {
        //setup data validattion rules
        $rules = ['firstname' => 'Required | Between: 1,20| alpha ','lastname' => 'Required | Between: 1,20| alpha_dash | regex:/^[\pL\s\-]+$/u', 'email' => 'Required | E-mail', 'username' => 'Required | Between: 1,20| alpha_dash','password' => 'Required | Between: 4,20'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
    //accepts a request from the web browser to read a user by their credentials
    public function readByCredentials(Request $request){
        
        try{
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
                
                    //set session user id
                    $request->session()->put('userid', $userId);
                    
                    //get the role of the user object
                    $role = $user_ob->getRole();
                    
                    //set the role session
                    $request->session()->put('role', $role);
                    
                    //Render a response view of the user profile
                    return redirect()->action('UserProfileController@index');
                }
                
            }else{
                
                //Render a response View with unsuccessful message
                return view('unsuccessfulView');
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
    
    private function validateLoginForm(Request $request) {
        //setup data validattion rules
        $rules = ['username' => 'Required | Between: 1,20| Alpha','password' => 'Required | Between: 4,20'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
    //simply returns all of the users in an array
    public function readAll(){
        
        try{
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
                return view('unsuccessfulView');
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts a request from the web browser to suspend a user 
    public function suspendById(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to suspend a user in the database
            if($bs->suspendById($id)){
                //Render a response View with success message
                return view('adminPageOfUsersView');
                
            }else{
                //Render a response View with unsuccessful message
                return view('unsuccessfulView');
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts a request from the web browser to suspend a user
    public function unsuspendById(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to suspend a user in the database
            if($bs->unsuspendById($id)){
                //Render a response View with success message
                return view('adminPageOfUsersView');
                
            }else{
                //Render a response View with unsuccessful message
                return view('unsuccessfulView');
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts the request from the web browser to delete an existing record of an user
    public function delete(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to delete a user in the database
            if($bs->delete($id)){
                //Render a response View with success message
                return view('adminPageOfUsersView');
                
            }else{
                //Render a response View with unsuccessful message
                return view('unsuccessfulView');
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //simply breaks the session variable; logs out the user
    public function logout(Request $request){
        
        try{
            //destroy the session 
            $request->session()->flush(); 
            $request->session()->save(); 
            
            if(!$request->session()->has('userid') && !$request->session()->has('role')) { 
                
                //Render a response view of the admin page of users and pass on the array of users
                return view('homeView');    
                                
            }else{
                //Render a response View with unsuccessful message
                return view('unsuccessfulView');
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}
