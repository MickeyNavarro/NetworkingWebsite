<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to job postings
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\Utility\ILoggerService;
use App\Models\JobPostingsModel;
use App\Services\BusinessServices\JobPostingsBusinessService;

class JobPostingsController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of job posting
    public function create(Request $request){
        
        try{
            $this->logger->info("Entering JobPostingsController.create()");
            
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
                
                //Use the business service object to show all users in the database
                if($jobs = $jbs->readAll()){
                    
                    //compress all the users into a single array
                    $Data = [ 'jobs' => $jobs ];
                    
                    //Render a response view of the admin page of jobs and pass on the array of jobs
                    return view('adminPageOfJobsView')->with($Data);
                    
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with creating this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            
            $this->logger->error("Leaving JobPostingsController.create() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to show an existing record of job posting
    public function readByJobID(Request $request){
        
        try{
            $this->logger->info("Entering JobPostingsController.readByJobID()");
            
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
                $errorMessage = "Sorry! Something went wrong with showing this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving JobPostingsController.readByJobID() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts the request from the web browser to show a single existing record of job posting
    //method is no longer in use due to JobPostingRestController
    public function showIndJob(Request $request){
        
        try{
            $this->logger->info("Entering JobPostingsController.showIndJob()");
            
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
                return view('jobView')->with($data);
                
            }else{
                //Render a response view with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with showing this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving JobPostingsController.showIndJob() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //simply returns all of the job postings in an array 
    public function readAll(){
        
        try{
            $this->logger->info("Entering JobPostingsController.readAll()");
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Use the business service object to show all users in the database
            if($jobs = $jbs->readAll()){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('adminPageOfJobsView')->with($Data);
                
            }else{
                //create the error message
                $errorMessage = "Sorry, but there were no jobs found!"; 
                
                //send the error message 
                $Data = ['errorMessage' => $errorMessage]; 
                
                //Render a response View with unsuccessful message
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving JobPostingsController.readAll() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //simply returns all of the job postings in an array
    public function showAll(){
        
        try{
            $this->logger->info("Entering JobPostingsController.showAll()");
            
            //get the user id from the session variable
            $id = session()->get('userid');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Use the business service object to show all matched jobs in the database
            if($jobs = $jbs->readMatches($id)){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('jobsView')->with($Data);
                
            //Use the business service object to show all the jobs in the database
            }else if($jobs = $jbs->readAll()){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('jobsView')->with($Data);
            
            }else{
                //create the error message
                $errorMessage = "Sorry, but there were no jobs found!";
                
                //send the error message
                $Data = ['errorMessage' => $errorMessage];
                
                //Render a response View with unsuccessful message
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving JobPostingsController.showAll() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //accepts the request from the web browser to update an existing record of job posting
    public function update(Request $request){
        
        try{
            $this->logger->info("Entering JobPostingsController.update()");
            
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
                
                //Use the business service object to show all users in the database
            if($jobs = $jbs->readAll()){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('adminPageOfJobsView')->with($Data);
                
            }
                                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with updating this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch(ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e){
            $this->logger->error("Leaving JobPostingsController.update() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
        
    }
    
    //accepts the request from the web browser to delete an existing record of job posting
    public function delete(Request $request){
        try{
            $this->logger->info("Entering JobPostingsController.delete()");
            
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Use the business service object to delete a job posting in the database
            if($jbs->delete($id)){
                //Use the business service object to show all users in the database
                if($jobs = $jbs->readAll()){
                    
                    //compress all the users into a single array
                    $Data = [ 'jobs' => $jobs ];
                    
                    //Render a response view of the admin page of jobs and pass on the array of jobs
                    return view('adminPageOfJobsView')->with($Data);
                    
                }
                
            }else{
                //Render a response View with unsuccessful message
                $errorMessage = "Sorry! Something went wrong with deleting this job.";
                $Data = [ 'errorMessage' => $errorMessage ];
                return view('unsuccessfulView')->with($Data);
            }
        }
        catch (Exception $e){
            $this->logger->error("Leaving JobPostingsController.delete() with Exception Error: ", array("message" => $e->getMessage()));
            
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['name' => 'Required | Between: 1,50','company' => 'Required ', 'pay' => 'Required', 'description' => 'Required'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
}
