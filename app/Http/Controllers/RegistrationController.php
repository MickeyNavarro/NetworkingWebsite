<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The controller that handles registration for a new user

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\BusinessServices\UserBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PHPUnit\Exception;


class RegistrationController extends Controller
{
    public function index(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $first = $request->input('firstname');
            $last = $request->input('lastname');
            $email = $request->input('email');
            $username = $request->input('username');
            $password = $request->input('pass');
                      
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Create a new user object with the form data
            $newUser = new UserModel(0, $first, $last, $email, $username, $password, 0, 0);
            
            //Use the business service object to create a new user in the database
            if($bs->createNewUser($newUser)){
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
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['firstname' => 'Required | Between: 1,20| Alpha','lastname' => 'Required | Between: 1,20| Alpha', 'email' => 'Required | E-mail', 'username' => 'Required | Between: 1,20| Alpha','pass' => 'Required | Between: 1,20'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
}
