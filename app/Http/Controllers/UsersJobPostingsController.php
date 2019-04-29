<?php
//Almicke Navarro
//3-1-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to user job postings
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Services\Utility\ILoggerService;
use App\Models\UsersJobPostingsModel;

class UsersJobPostingsController extends Controller
{
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of user job postings by saving a job post
    public function save(Request $request){
        
        try{            
            //Store the form data
            $job_postings_id = $request->input('id');
            $save = 1; 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService(); 
            
            //Create a new user job postings object with the form data
            $uj = new UsersJobPostingsModel(0, $save, null, $userid, $job_postings_id); 
            
            //Use the business service object to create a new user job postings in the database
            if($ujbs->create($uj)){
                //Render a response View
                return redirect()->action('UserProfileController@index');
                
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
    
    //accepts the request from the web browser to create a new record of user job postings by applying for a job post
    public function apply(Request $request){
        
        try{            
            //Store the form data
            $job_postings_id = $request->input('id');
            $apply = 1; 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //Create a new user job postings object with the form data
            $uj = new UsersJobPostingsModel(0, null, $apply, $userid, $job_postings_id);
            
            //Use the business service object to create a new user job postings in the database
            if($ujbs->create($uj)){
                //Render a response View
                return redirect()->action('UserProfileController@index');
                
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
    
    //accepts the request from the web browser to show an existing record of user's saved job postings
    public function showSaved(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //create a variable to hold the user job postings stuff
            $savedjobs = $ujbs->readSaved($id);
            
            //check if the the business service object returned an user job postings object
            if($savedjobs !=null){
                
                //compress the group array to be sent to the view
                $data = ['savedjobs' => $savedjobs];
                
                //Render a response View with success message
                return view('userSavedJobsView')->with($data);
                
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
    
    //accepts the request from the web browser to show an existing record of user's saved job postings
    public function showApplied(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //create a variable to hold the user job postings stuff
            $appliedjobs = $ujbs->readApplied($id); 
            
            //check if the the business service object returned an user job postings object
            if($appliedjobs !=null){
                
                //compress the group array to be sent to the view
                $data = ['appliedjobs' => $appliedjobs];
                
                //Render a response View with success message
                return view('userAppliedJobsView')->with($data);
                
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
    //accepts the request from the web browser to delete an existing record of user job postings
    public function unsave(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //Use the business service object to delete the record of user job postings in the database
            if($ujbs->delete($id)){
                //Render a response View
                return redirect()->action('UserProfileController@index');
                
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
