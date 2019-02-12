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

//This route is mapped to the '/profile' URI and will display the user profile page
Route::get('/viewProfile', function(){
    
    return view('userProfileView');
});

//This route is mapped to the '/addPersonInformationView' URI and will display the page that allows user to enter their personal information
Route::get('/addPersonalInformation', function(){
    
    return view('personalInformationView');
});

//The route is mapped to the '/personalInformationView' and will post the user input from the login view
Route::post('/personalInformationView', 'PersonalInformationController@index'); 

//This route is mapped to the '/addEducationView' URI and will display the page that allows the user at enter their education
Route::get('/addEducationView', function(){
    
    return view('educationView');
});

//The route is mapped to the '/skillsView' and will post the user input from the skills view
Route::post('/educationView', 'EducationController@index'); 

//This route is mapped to the '/addExperienceView' URI and will display the page that allows the user at enter their experience
Route::get('/addWorkExperienceView', function(){
    
    return view('workExperienceView');
});

//The route is mapped to the '/skillsView' and will post the user input from the skills view
Route::post('/workExperienceView', 'WorkExperienceController@index'); 

//This route is mapped to the '/addSkillView' URI and will display the page that allows the user at enter their skills
Route::get('/addSkillView', function(){
    
    return view('skillsView');
});

//The route is mapped to the '/skillsView' and will post the user input from the skills view
Route::post('/skillsView', 'SkillsController@index'); 
    
//This route is mapped to the '/adminPageView' URI and will display the page that allows the admin to perform admin functions
Route::get('/adminPage', function(){
    
    return view('adminPageView');
});

//this route wil output the session variables
Route::get('session/get','SessionController@accessSessionData');

//The route is mapped to the '/suspendView' and will get the user id from the admin view to suspend them
Route::get('/suspendView', 'SuspendController@index'); 

//The route is mapped to the '/suspendView' and will get the user id from the admin view to suspend them
Route::get('/unsuspendView', 'UnsuspendController@index'); 

//The route is mapped to the '/deleteView' and will get the user id from the admin view to delete them
Route::get('/deleteView', 'DeleteController@index'); 

