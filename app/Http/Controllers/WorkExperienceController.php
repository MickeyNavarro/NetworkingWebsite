<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles adding user work experience
namespace App\Http\Controllers;


use App\Services\BusinessServices\MemberProfileBusinessService;
use App\Models\WorkExperienceModel;
use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkExperienceController extends Controller
{
    public function index(Request $request){
        
        try{
            //Store the form data
            $pos = $request->input('position');
            $com = $request->input('company');
            $loc = $request->input('location');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo'); 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $bs = new MemberProfileBusinessService();
            
            //Create a new work experience object with the form data
            $newWork = new WorkExperienceModel(0, $pos, $com, $loc, $start, $end, $info, $userid); 
            
            //Use the business service object to create a new user in the database
            if($bs->createNewWorkExperience($newWork)){
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
