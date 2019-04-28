<?php
//Almicke Navarro
//4-5-19
//Networking Milestone
//This is my own work.
//middleware that checks how long the user has been logged in 

namespace App\Http\Middleware;

use App\Services\Utility\MyLogger;
use Illuminate\Support\Facades\Cache;
use Closure;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //step 1: you can use the following to get the route URI $request->path() OR you can also use the $request->is()
        $path = $request->path();
        $log = new MyLogger(); 
        $log->info("Entering Security Middleware in handle() at path: " . $path);
        
        //setp 2: run the business rules that check for all URI's that you DO NOT need to secure
        $secureCheck = true;
        if ($request->is('/login')|| $request->is('/registration') ||  $request->is('/home')) {
            $secureCheck == false;
            
            // '?' tests if $secureCheck is true or false; if true,
            $log->info($secureCheck ? "Security Middleware in handle()... Needs security" : "Security Middleware in handle()..... No security required");
            
            //step 3: if enter
            if (!$request->session()->has('userid')&& $secureCheck) {
                $log->info("Leaving My Security Middleware in handle() doing a redirect back to login");
                return redirect('login');
                
            }
            
        }
        
        return $next($request);
    }
}
