<?php
//Almicke Navarro
//3-2-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to user groups
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Models\UsersGroupsModel;
use App\Services\BusinessServices\GroupsBusinessService;

class UsersGroupsController extends Controller
{
    //accepts the request from the web browser to create a new record of a user joining a group
    public function create(Request $request){
        
        try{
            
            //Store the form data
            $groups_id = $request->input('id');
            
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
    
    //accepts the request from the web browser to show all the users that belong to a single group
    public function readByGroupId(Request $request){
        
        try{
            //Store the form data
            $groups_id = $request->input('id');
            
            //Create new business services
            $ugbs = new UsersGroupsBusinessService();
            $gbs = new GroupsBusinessService(); 
            
            //create a variable to hold the user groups stuff
            $groupusers = $ugbs->readByGroupID($groups_id); 
            $groupdata = $gbs->readByGroupId($groups_id);
            
                        
            //check if the the business service object returned an user groups object
            if($groupdata !=null){

                //compress all the user data into a single array
                $data = ['groupdata' => $groupdata, 'groupusers' => $groupusers];
                
                //compress the user groups array to be sent to the view
                return view('groupView')->with($data);
                
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
            $ugbs = new UsersGroupsBusinessService();
            
            //Use the business service object to delete the record of user  in the database
            if($ugbs->delete($id)){
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
