<?php
//Almicke Navarro
//3-2-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to user groups
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Models\UsersGroupsModel;

class UsersGroupsController extends Controller
{
    //accepts the request from the web browser to create a new record of a user joining a group
    public function create(Request $request){
        
        try{
            //validate the form data
            $this->validateForm($request);
            
            //Store the form data
            $groups_id = $request->input('groupid');
            
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ugbs = new UsersGroupsBusinessService();
            
            //Create a new users groups object with the form data
            $usergroup = new UsersGroupsModel(0, $userid, $groups_id); 
            
            //Use the business service object to create a new user group in the database
            if($ugbs->create($usergroup)){
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
    
    //accepts the request from the web browser to show all the groups a user is in by their id 
    public function readByUserId(Request $request){
        
        try{
            //check if the userid session variable has been set
            if ($request->session()->has('userid')) {
                $userid = $request->session()->get('userid');
            }
            
            //Create a new business service
            $ugbs = new UsersGroupsBusinessService();
            
            //create a variable to hold the user groups stuff
            $usergroups = $ugbs->readByUserID($userid);
            
            //check if the the business service object returned an user groups object
            if($usergroups !=null){
                
                //compress the user groups array to be sent to the view
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
    
    //accepts the request from the web browser to delete an existing record of a user within a group (basically the user leaves the group)
    public function delete(Request $request){
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $gbs = new GroupsBusinessService();
            
            //Use the business service object to delete the record of user  in the database
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
