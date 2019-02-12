<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The controller that handles user login 

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\BusinessServices\UserBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PHPUnit\Exception;
use function GuzzleHttp\json_decode;

session_start();

class LoginController extends Controller
{  
    public function index(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $username = $request->input('username');
            $password = $request->input('pass');
           
            //Create a new business service
            $bs = new UserBusinessService();
           
            //Create a new user object with the form data
            $user = new UserModel(0, null, null, null, $username, $password, null, null);
            
            //Use the business service object to attempt to login a user
                //If the user information is valid the user will see that they are logged in
                //If not they will be prompted to try again
            $userId = $bs->login($user);
            
            //use the user id to find the user object in which the id belongs to
            $uo = $bs->findById($userId); 
            
            //find out if the user has been suspended
            $suspend = $uo->getSuspend(); 
       
            //check if the user id was returned and if the user was not suspended
            if($userId != null && $suspend != 1){ 
                
                //set session user id
                $request->session()->put('userid', $userId);
                
                //get the role of the user object
                $role = $uo->getRole();
                                
                //set the role session
                $request->session()->put('role', $role);
                          
                
                //Render a response View with success message
                return view('userProfileView');
                        
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
    
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['username' => 'Required | Between: 1,20| Alpha','pass' => 'Required | Between: 1,20'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
