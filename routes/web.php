<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//The route is mapped to the '/login' URI and will display the login form 
Route::get('/login', function(){
    return view('loginView');
});

//This route is mapped to the '/registraion' URI and will display the registration form 
Route::get('/registration', function(){
    
    return view('registrationView');
});

//The route is mapped to the '/registrationView' and will post the user input from the registration view
Route::post('/registrationView', 'RegistrationController@index'); 

//This route is mapped to the '/login' URI and will display the login form
Route::get('/login', function(){
    
    return view('loginView');
});

//The route is mapped to the '/loginView' and will post the user input from the login view
Route::post('/loginView', 'LoginController@index'); 