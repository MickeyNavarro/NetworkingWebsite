<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BusinessServices\UserBusinessService;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class SuspendController extends Controller
{
    public function index(Request $request){
        
        try{
            //Store the form data
            //TODO:update on how to get the id
            $id = $request->input('id');
            
            //Create a new business service
            $bs = new UserBusinessService();
            
            //Use the business service object to suspend a user in the database
            if($bs->suspendById($id)){
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
