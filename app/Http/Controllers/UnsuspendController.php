<?php
//Almicke Navarro
//2-9-19
//Networking Milestone
//This is my own work.
//The controller that handles user unsuspension
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\BusinessServices\UserBusinessService;

class UnsuspendController extends Controller
{
    public function index(Request $request){
        
        try{
            //Store the form data
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to suspend a user in the database
            if($bs->unsuspendById($id)){
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
