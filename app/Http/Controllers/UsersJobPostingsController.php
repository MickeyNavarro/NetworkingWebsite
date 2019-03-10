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
use App\Models\UsersJobPostingsModel;

class UsersJobPostingsController extends Controller
{
    //accepts the request from the web browser to create a new record of user job postings by saving a job post
    public function save(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $ = $request->input('');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService(); 
            
            //Create a new user job postings object with the form data
            $uj = new UsersJobPostingsModel(0, $save, $apply, $userid, $job_postings_id); 
            
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
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $ = $request->input('');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //Create a new user job postings object with the form data
            $uj = new UsersJobPostingsModel(0, $save, $apply, $userid, $job_postings_id);
            
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
    
    //accepts the request from the web browser to show an existing record of user job postings
    public function read(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $ujbs  = new UsersJobPostingsBusinessService();
            
            //create a variable to hold the user job postings stuff
            $group = $ujbs->read($id);
            
            //check if the the business service object returned an user job postings object
            if($group !=null){
                
                //compress the group array to be sent to the view
                $data = ['group' => $group];
                
                //Render a response View with success message
                return view('updateSkillsView')->with($data);
                
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
    public function delete(Request $request){
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
