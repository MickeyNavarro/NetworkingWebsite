<?php

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
        
        //setp 2: run the business rules that check for all URI's that you fo not need to secure
        $secureCheck = true;
        if ($request->is('login')) {
            $secureCheck == false;
            
            // '?' tests if $secureCheck is true or false; if true,
            $log->info($secureCheck ? "Security Middleware in handle()... Needs security" : "Security Middleware in handle()..... No security required");
            
            //step 3: if enter
            /* if ($request->username !=null){
                $value = Cache::store("file")->get("mydata");
                if ($value == null) {
                    $log->info("Caching first time Username for ". $request->username);
                    Cache::store("file")->put("mydata", $request->username, 1);
                    $enable = true;
                    
                }
                
            }
            else {
                $value = Cache::store("file")->get("mydata");
                if ($value != null) {
                    $log->info("Getting username from cache " . $value);
                    $enable = true;
                    
                }else {
                    $log->info("Could not get Username from cache (data is older than 1 minute)");
                    $enable = false;
                    
                }
            } */
            
            $enable = false;
            
            if ($enable && $secureCheck) {
                $log->info("Leaving My Security Middleware in handle() doing a redirect back to login");
                return redirect('login');
                
            }
        }
        return $next($request);
    }
}
