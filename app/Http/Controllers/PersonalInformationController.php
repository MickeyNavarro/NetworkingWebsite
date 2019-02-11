<?php
namespace Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Models\PersonalInformationModel;
use App\Services\BusinessServices\MemberProfileBusinessService;
use PHPUnit\Exception;


class PersonalInformationController
{
    public function index(Request $request){
        
        try{            
            //Store the form data
            $photo = $request->input('file');
            $location = $request->input('location');
            $biography = $request->input('bio');
            $contact_email = $request->input('email');
            $phone_number = $request->input('phone');
            $userid = $request->input('userid'); 
            
            //Create a new business service
            $bs = new MemberProfileBusinessService();
            
            //Create a new personal information object with the form data
            $newPI = new PersonalInformationModel(0, $photo, $location, $biography, $contact_email, $phone_number, $userid); 
            
            //Use the business service object to create a new user in the database
            if($bs->createNewPersonalInformation($newPI)){
                //Render a response View with success message
                return view('userProfileView');
                
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

