<?php
//Almicke Navarro
//2-28-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to groups
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\GroupsBusinessService;
use App\Services\Utility\ILoggerService;
use App\Models\GroupsModel;

class GroupsController extends Controller
{
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    //accepts the request from the web browser to create a new record of group
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $name = $request->input('name');
            $des = $request->input('description'); 
            
            //Create a new business service
            $gbs = new GroupsBusinessService(); 
            
            //Create a new groups object with the form data
            $group = new GroupsModel(0, $name, $des); 
            
            //Use the business service object to create a new group in the database
            if($gbs->create($group)){
                //Render a response View
                return redirect('/adminPageOfGroupsView');
                
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
    
    //accepts the request from the web browser to show an existing record of group
    public function readByGroupId(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //create a variable to hold the groups stuff
            $group = $gbs->readByGroupId($id); 
            
            //check if the the business service object returned an groups object
            if($group !=null){
                
                //compress the group array to be sent to the view
                $data = ['group' => $group];
                
                //Render a response View with success message
                return view('updateGroupsView')->with($data);
                
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
    
    //accepts the request from the web browser to show all groups
    public function readAll(Request $request){
        
        try{            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //create a variable to hold the groups stuff
            $groups = $gbs->readAll(); 
            
            //check if the the business service object returned an groups object
            if($groups !=null){
                
                //compress the group array to be sent to the view
                $data = ['groups' => $groups];
                
                //Render a response View with success message
                return view('adminPageOfGroupsView')->with($data);
                
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
    
    //accepts the request from the web browser to show all groups
    public function userReadAll(Request $request){
        
        try{
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //create a variable to hold the groups stuff
            $groups = $gbs->readAll();
            
            //check if the the business service object returned an groups object
            if($groups !=null){
                
                //compress the group array to be sent to the view
                $data = ['groups' => $groups];
                
                //Render a response View with success message
                return view('groupsView')->with($data);
                
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
    
    //accepts the request from the web browser to update an existing record of group
    public function update(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $id = $request->input('id');
            $group_name = $request->input('name');
            $des = $request->input('description');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //Create a new group object with the form data
            $group = new GroupsModel($id, $group_name, $des);
            
            //Use the business service object to update a new skill in the database
            if($gbs->update($group)){
                //Render a response View with success message
                return redirect('/adminPageOfGroupsView');
                
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
    
    //accepts the request from the web browser to delete an existing record of group
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //Use the business service object to delete the record of group in the database
            if($gbs->delete($id)){
                //Render a response View
                return redirect('/adminPageOfGroupsView');
                
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
        $rules = ['name' => 'Required | Between: 1,40'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
