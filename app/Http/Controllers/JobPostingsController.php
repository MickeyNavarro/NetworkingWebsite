<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to job postings
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\JobPostingsBusinessService;
use App\Models\JobPostingsModel;

class JobPostingsController extends Controller
{
    //accepts the request from the web browser to create a new record of job posting
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $name = $request->input('name');
            $com = $request->input('company');
            $pay = $request->input('pay');
            $des = $request->input('description');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService(); 
            
            //Create a new job postings object with the form data
            $job = new JobPostingsModel(0, $name, $com, $pay, $des); 
                    
            //check if the creation was a success
            if($jbs->create($job)){
                
                //Render a response View
                return redirect('/adminPageOfJobsView');
                
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
    
    //accepts the request from the web browser to show an existing record of job posting
    public function readByJobID(Request $request){
        
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
                
                //Render a response View with success message
                return view('updateJobPostingsView')->with($data);
                
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
    
    //simply returns all of the job postings in an array 
    public function readAll(){
        
        try{
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Use the business service object to show all users in the database
            if($jobs = $jbs->readAll()){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('adminPageOfJobsView')->with($Data);
                
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
    
    //accepts the request from the web browser to update an existing record of job posting
    public function update(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id'); 
            $name = $request->input('name');
            $com = $request->input('company');
            $pay = $request->input('pay');
            $des = $request->input('description');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Create a new object with the form data
            $job = new JobPostingsModel($id, $name, $com, $pay, $des); 
            
            //check if the method was a success
            if($jbs->update($job)){
                
                /* //compress the job posting array to be sent to the view
                $data = ['id' => $id]; */
                
                //Render a response View
                return redirect('/adminPageOfJobsView');
                                
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
    
    //accepts the request from the web browser to delete an existing record of job posting
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Use the business service object to delete a job posting in the database
            if($jbs->delete($id)){
                //Render a response View
                return redirect('/adminPageOfJobsView');
                
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
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['name' => 'Required | Alpha','company' => 'Required | Alpha', 'pay' => 'Required', 'description' => 'Required'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
