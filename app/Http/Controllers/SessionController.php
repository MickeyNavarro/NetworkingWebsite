<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function accessSessionData(Request $request) {
        if($request->session()->has('userid')) {
            echo $request->session()->get('userid');
            echo $request->session()->get('role');
            
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
