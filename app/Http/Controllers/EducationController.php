<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to education
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\EducationModel;
use App\Services\BusinessServices\EducationBusinessService;

class EducationController extends Controller
{
    //accepts the request from the web browser to create a new record of education
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
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
            $bs = new EducationBusinessService(); 
            
            //Create a new education object with the form data
            $edu = new EducationModel(0, $school, $degree, $start, $end, $info, $userid);
            
            //Use the business service object to create a new education in the database
            if($bs->create($edu)){
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
    //accepts the request from the web browser to show an existing record of education
    public function readByEduID(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new EducationBusinessService();
            
            //create a variable to hold the education stuff 
            $edu = $bs->readByEduID($id); 
            
            //check if the the business service object returned an education object
            if($edu !=null){
                
                //compress the education array to be sent to the view
                $data = ['edu' => $edu]; 
                
                //Render a response View with success message
                return view('updateEducationView')->with($data);
                
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
    //accepts the request from the web browser to update an existing record of education
    public function update(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id'); 
            $school = $request->input('school');
            $degree = $request->input('degree');
            $start = $request->input('startYear');
            $end = $request->input('endYear');
            $info = $request->input('additionalInfo');
            
            //Create a new business service
            $bs = new EducationBusinessService();
            
            //Create a new education object with the form data
            $edu = new EducationModel($id, $school, $degree, $start, $end, $info, null);
            
            //Use the business service object to update a new education in the database
            if($bs->update($edu)){
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
    
    //accepts the request from the web browser to delete an existing record of education
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new EducationBusinessService();
            
            //Use the business service object to delete the record of education in the database
            if($bs->delete($id)){
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
        $rules = ['school' => 'Required | Alpha','degree' => 'Required | Alpha', 'startYear' => 'Required | Numeric | Between: 1,4', 'endYear' => 'Required | Numeric | Between: 1,4','additionalInfo' => 'Required'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }

}
