<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to work experience
namespace App\Http\Controllers;


use App\Models\WorkExperienceModel;
use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\Utility\ILoggerService;


class WorkExperienceController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of work experience
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $pos = $request->input('position');
            $com = $request->input('company');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo'); 
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService(); 
            
            //Create a new work experience object with the form data
            $newWork = new WorkExperienceModel(0, $pos, $com, $start, $end, $info, $userid); 
            
            //check if the creation was a success
            if($wbs->create($newWork)){
                //Render a response View with success message
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
    
    //accepts the request from the web browser to show an existing record of work experience
    public function readByWorkID(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService();
            
            //create a variable to hold the work education stuff
            $work = $wbs->readByWorkID($id); 
            
            //check if a work experience was returned
            if($work !=null){
                
                //compress the work experience array to be sent to the view
                $data = ['work' => $work];
                
                //Render a response view 
                return view('updateWorkExperienceView')->with($data);
                
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
    //accepts the request from the web browser to update an existing record of work experience
    public function update(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id');
            $pos = $request->input('position');
            $com = $request->input('company');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo'); 
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService();
            
            //Create a new object with the form data
            $work = new WorkExperienceModel($id, $pos, $com, $start, $end, $info, null); 
            
            //check if the method was a success
            if($wbs->update($work)){
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
    
    //accepts the request from the web browser to delete an existing record of work experience
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $wbs = new WorkExperienceBusinessService();
            
            //Use the business service object to delete a work experience in the database
            if($wbs->delete($id)){
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
    
    //validates the form and its data for consistency
    private function validateForm(Request $request) {
        //setup data validattion rules
        $rules = ['position' => 'Required | Between 1, 50','company' => 'Required', 'startYear' => 'Required | Numeric | Between: 1900,2019', 'endYear' => 'Required | Numeric | Between: 1900,2019','additionalInfo' => 'Required'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
