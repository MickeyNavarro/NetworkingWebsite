<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The controller that handles user login 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessServices\UserBusinessService;

class LoginController extends Controller
{
    public function index(Request $request){
        
        //Store the form data
        $username = $request->input('username');
        $password = $request->input('pass');
       
        //Create a new business service
        $bs = new UserBusinessService();
       
        //Use the business service object to attempt to login a user
        //If the user information is valid the user will see that they are logged in
        //If not ther will be prompted to try again
        if($bs->login($username, $password)){
            
            //Render a response View with success message
            return view('successfulView');
                    
        }else{
            
            //Render a response View with unsuccessful message
            return view('unsuccessfulView');
          
        }      
    }
}
