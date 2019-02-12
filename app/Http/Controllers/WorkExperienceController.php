<?php

namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\BusinessServices\MemberProfileBusinessService;
use App\Models\WorkExperienceModel;

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
            $userid = $request->session()->get('userid');
            
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
