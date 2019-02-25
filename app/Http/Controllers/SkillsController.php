<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles adding user skills 
namespace App\Http\Controllers;

use App\Models\SkillsModel;
use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\SkillsBusinessService;


class SkillsController extends Controller
{
    //accepts the request from the web browser to create a new record of skills
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $skill_name = $request->input('skill');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $sbs = new SkillsBusinessService(); 
            
            //Create a new skills object with the form data
            $skill = new SkillsModel(0, $skill_name, $userid);
            
            //Use the business service object to create a new skill in the database
            if($sbs->create($skill)){
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
    
    //accepts the request from the web browser to show an existing record of skills
    public function readBySkillID(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $sbs = new SkillsBusinessService();
            
            //create a variable to hold the skills stuff
            $skills = $sbs->readBySkillID($id);
            
            //check if the the business service object returned an skills object
            if($skills !=null){
                
                //compress the skill array to be sent to the view
                $data = ['skills' => $skills];
                
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
    //accepts the request from the web browser to update an existing record of skill
    public function update(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id'); 
            $skills_name = $request->input('skill');
            
            //Create a new business service
            $sbs = new SkillsBusinessService();
            
            //Create a new skill object with the form data
            $skill = new SkillsModel($id, $skills_name, null); 
            
            //Use the business service object to update a new skill in the database
            if($sbs->update($skill)){
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
    
    //accepts the request from the web browser to delete an existing record of skill
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $sbs = new SkillsBusinessService();
            
            //Use the business service object to delete the record of skill in the database
            if($sbs->delete($id)){
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
        $rules = ['skill' => 'Required | Alpha'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
