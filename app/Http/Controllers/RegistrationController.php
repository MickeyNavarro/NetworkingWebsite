<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The controller that handles registration for a new user

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessServices\UserBusinessService;
use App\Models\User;


class RegistrationController extends Controller
{
    public function index(Request $request){
        
        //Store the form data
        $first = $request->input('firstname');
        $last = $request->input('lastname');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('pass');
        
        
        //Create a new business service
        $bs = new UserBusinessService();
        
        //Create a new user object with the form data
        $newUser = new User(0, $first, $last, $email, $username, $password, 0);
        
        //Use the business service object to create a new user in the database
        //$bs->createNewUser($newUser);
        
        if($bs->createNewUser($newUser)){
            //Render a response View with success message
            return view('successfulView');
            
        }else{
            
            //Render a response View with unsuccessful message
            return view('unsuccessfulView');
            
        }
                
    }
    
}
