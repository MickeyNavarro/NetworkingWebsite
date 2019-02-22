<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles adding user education
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\BusinessServices\MemberProfileBusinessService;
use App\Models\EducationModel;

class EducationController extends Controller
{
    public function index(Request $request){
        
        try{
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
            $bs = new MemberProfileBusinessService(); 
            
            //Create a new education object with the form data
            $edu = new EducationModel(0, $school, $degree, $start, $end, $info, $userid);
            
            //Use the business service object to create a new user in the database
            if($bs->createNewEducation($edu)){
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