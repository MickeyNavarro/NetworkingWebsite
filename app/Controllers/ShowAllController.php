<?php
//Almicke Navarro
//2-8-19
//Networking Milestone
//This is my own work.
//The controller that handles adding showing all users
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BusinessServices\UserBusinessService;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class ShowAllController extends Controller
{
    public function index(){
        
        try{       
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to show all users in the database
            if($users = $bs->showAll()){
                
                //Render a response View with success message
                return view('adminPageView');
                
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
