<?php
//Almicke Navarro
//2-22-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to outputting the job postings profile
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BusinessServices\JobPostingsBusinessService;

class JobPostingsProfileController extends Controller
{
    //accepts the request from the web browser to return all the job postings data needed on the profile page
    public function index(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService(); 
            
            //create a variable to hold the job posting stuff
            $job = $jbs->readByJobID($id);
            
            //check if a job posting was returned
            if($job !=null){
                
                //compress the job posting array to be sent to the view
                $data = ['job' => $job];
                
                //Render a response View
                return view('jobPostingProfileView')->with($data);
                
            }else{
                //Render a response view with unsuccessful message
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
