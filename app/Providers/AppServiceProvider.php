<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //resource: https://gist.github.com/abdullahbutt/ea171f53e4af167d50d92d439c4d97d3
        
        // If you are running lower version of MySQL then you may get following error : 1071 Specified key was too long; max key length is 767 bytes
        // To fix this, I'm setting max string length of all db fields by default to 191
        Schema::defaultStringLength(191); //Solved by decreasing StringLength to 191 instead of by default 255
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            
            // This will only accept alpha and spaces.
            return preg_match('/^[\pL\s]+$/u', $value);
            
        });
        Validator::extend('alpha_spaces_dashes', function ($attribute, $value) {
                
                // This will only accept alpha, spaces, and dashes.
                return preg_match('/^[\pL\s-]+$/u', $value);
                
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
