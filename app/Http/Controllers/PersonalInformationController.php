<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to personal information
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\PersonalInformationModel;
use PHPUnit\Exception;
use App\Services\BusinessServices\PersonalInformationBusinessService;


class PersonalInformationController
{
    //accepts the request from the web browser to create a new record of personal info 
    public function create(Request $request){
        
        try{           
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $photo = $request->input('file');
            $biography = $request->input('bio');
            $current_position = $request->input('pos'); 
            $contact_email = $request->input('email');
            $phone_number = $request->input('phone');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService(); 
            
            //Create a new personal information object with the form data
            $pi = new PersonalInformationModel(0, $biography, $current_position, $contact_email, $phone_number, $photo, $userid); 
            
            //Use the business service object to create a new user in the database
            if($pbs->create($pi)){
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
    
    //accepts the request from the web browser to show an existing record of personal info 
    public function readByPersonalInfoID(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService();
            
            //create a variable to hold the personal info 
            $pi = $pbs->readByPersonalInfoID($id); 
            
            //check if a personal info was returned
            if($pi !=null){
                
                //compress the personal info array to be sent to the view
                $data = ['pi' => $pi];
                
                //Render a response view
                return view('updatePersonalInformationView')->with($data);
                
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
    //accepts the request from the web browser to update an existing record of personal info
    public function update(Request $request){
        try{ 
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $photo = $request->input('file');
            $biography = $request->input('bio');
            $current_position = $request->input('pos');
            $contact_email = $request->input('email');
            $phone_number = $request->input('phone');
            $id = $request->input('id');
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService();
            
            //Create a new object with the form data
            $pi = new PersonalInformationModel($id, $biography, $current_position, $contact_email, $phone_number, $photo, null);   
            
            //check if the method was a success
            if($pbs->update($pi)){
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
    
    //accepts the request from the web browser to delete an existing record of personal info
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $pbs = new PersonalInformationBusinessService();
            
            //Use the business service object to delete a personal info in the database
            if($pbs->delete($id)){
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
        $rules = ['bio' => 'Required','pos' => 'Required | Alpha', 'email' => 'Required | E-Mail', 'phone' => 'Required | Numeric | Between: 1,15'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}

