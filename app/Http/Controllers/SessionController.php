<?php
//Almicke Navarro
//2-10-19
//Networking Milestone
//This is my own work.
//The controller that handles the testing of the sessions
namespace App\Http\Controllers;

use App\Services\Utility\ILoggerService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    public function accessSessionData(Request $request) {
        if($request->session()->has('userid')) {
            echo "User ID:" . $request->session()->get('userid') . "<br>";
            echo "Role: ". $request->session()->get('role'). "<br>";
            
        }
        else {
                echo 'No data in the session';
        }
    }
    //no routes to these functions
    /*
    public function storeSessionData(Request $request) {
        $request->session()->put('my_name','Virat Gandhi');
        echo "Data has been added to session";
    }
    public function deleteSessionData(Request $request) {
        $request->session()->forget('my_name');
        echo "Data has been removed from session.";
    }
    */
}
