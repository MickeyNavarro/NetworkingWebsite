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


Route::get('/home', function () {
    return view('homeView');
});

//-------------------------------------------------------------------------------------
    
//ROUTES RELATING TO LOGIN, REGISTRATION, AND LOGOUT

//The route is mapped to the '/login' URI and will display the login form 
Route::get('/login', function(){
    return view('loginView');
});

//The route is mapped to the '/loginView' and will post the user input from the login view
Route::post('/loginView', 'UserController@readByCredentials'); 

//This route is mapped to the '/registraion' URI and will display the registration form 
Route::get('/registration', function(){
    
    return view('registrationView');
});

//The route is mapped to the '/registrationView' and will post the user input from the registration view
Route::post('/registrationView', 'UserController@create'); 

//The route is mapped to the '/logout' URI and will display the home page
Route::get('/logout', function(){
    return view('homeView');
});
    

//-------------------------------------------------------------------------------------


//ROUTES RELATED TO THE USER PROFILE 

//This route is mapped to the '/viewProfile' URI and will display the user profile page
Route::get('/viewProfile', 'UserProfileController@index');

//-------------------------------------------------------------------------------------
    

//ROUTES RELATED TO THE PERSONAL INFORMATION 

//This route is mapped to the '/addPersonInformationView' URI and will display the page that allows user to enter their personal information
Route::get('/addPersonalInformation', function(){
    
    return view('addPersonalInformationView');
});

//The route is mapped to the '/addPersonalInformationView' and will post the user input from the personal info view
Route::post('/addPersonalInformationView', 'PersonalInformationController@create');

//This route is mapped to the '/updatePersonalInformationView' URI and will read the personal info data
Route::get('/updatePersonalInformationView', 'PersonalInformationController@readByPersonalInfoID');

//The route is mapped to the '/updatedPersonalInformationView' and will update the personal info data
Route::post('/updatedPersonalInformationView', 'PersonalInformationController@update');

//The route is mapped to the '/deletePersonalInformationView' and will get the personal info id from the user profile view to delete them
Route::get('/deletePersonalInformationView', 'PersonalInformationController@delete'); 



//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE EDUCATION 

//This route is mapped to the '/addEducationView' URI and will display the page that allows the user at enter their education
Route::get('/addEducationView', function(){
    
    return view('addEducationView');
});

//The route is mapped to the '/addedEducationView' and will post the user input from the education view
Route::post('/addedEducationView', 'EducationController@create'); 

//This route is mapped to the '/updateEducationView' URI and will read the education data
Route::get('/updateEducationView', 'EducationController@readByEduID');

 //The route is mapped to the '/updatedEducationView' and will update the education data
Route::post('/updatedEducationView', 'EducationController@update');

//The route is mapped to the '/deleteView' and will get the education id from the user profile view to delete them
Route::get('/deleteEducationView', 'EducationController@delete'); 

//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE WORK EXPERIENCE 

//This route is mapped to the '/addExperienceView' URI and will display the page that allows the user at enter their work experience
Route::get('/addWorkExperienceView', function(){
    
    return view('addWorkExperienceView');
});

//The route is mapped to the '/addedWorkExperienceView' and will post the user input from the work experience view
Route::post('/addedWorkExperienceView', 'WorkExperienceController@create');

//This route is mapped to the '/updateWorkExperienceView' URI and will read the work experience data
Route::get('/updateWorkExperienceView', 'WorkExperienceController@readByWorkID');

//The route is mapped to the '/updatedWorkExperienceView' and will update the work experience data
Route::post('/updatedWorkExperienceView', 'WorkExperienceController@update');

//The route is mapped to the '/deleteWorkExperienceView' and will get the work experience id from the user profile view to delete them
Route::get('/deleteWorkExperienceView', 'WorkExperienceController@delete'); 

//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE SKILLS

//This route is mapped to the '/addSkillView' URI and will display the page that allows the user at enter their skills
Route::get('/addSkillsView', function(){
    
    return view('addSkillsView');
});

//The route is mapped to the '/addedSkillsView' and will post the user input from the skill view
Route::post('/addedSkillsView', 'SkillsController@create');
    
//This route is mapped to the '/updateSkillsView' URI and will read the skill data
Route::get('/updateSkillsView', 'SkillsController@readBySkillID');
    
//The route is mapped to the '/updatedSkillsView' and will update the skill data
Route::post('/updatedSkillsView', 'SkillsController@update');
    
//The route is mapped to the '/deleteSkillsView' and will get the skill id from the user profile view to delete them
Route::get('/deleteSkillsView', 'SkillsController@delete'); 
    

//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE USER ADMIN PAGE

//This route is mapped to the '/adminPageOfUsersView' URI and will display the page that allows the admin to perform admin functions
Route::get('/adminPageOfUsersView', 'UserController@readAll');

//The route is mapped to the '/suspendView' and will get the user id from the admin view to suspend them
Route::get('/suspendView', 'UserController@suspendById');
    
//The route is mapped to the '/suspendView' and will get the user id from the admin view to unsuspend them
Route::get('/unsuspendView', 'UserController@unsuspendById');
    
//The route is mapped to the '/deleteView' and will get the user id from the admin view to delete them
Route::get('/deleteView', 'UserController@delete'); 

//-------------------------------------------------------------------------------------
    
//ROUTES RELATED TO THE JOB POSTINGS (ADMIN INTERACTIONS)

//This route is mapped to the '/jobPostingsView' URI and will display the page for a individual job posting
Route::get('/jobPostingsView','JobPostingsProfileController@index'); 
    
//This route is mapped to the '/adminPageOfJobsView' URI and will display the page that allows the admin to perform admin functions
Route::get('/adminPageOfJobsView', 'JobPostingsController@readAll');

//This route is mapped to the '/addJobPostingsView' URI and will display the page that allows the admins at enter job postings
Route::get('/addJobPostingsView', function(){
    
    return view('addJobPostingsView');
});
    
//The route is mapped to the '/addedJobPostingsView' and will post the admin input from the job postings view
Route::post('/addedJobPostingsView', 'JobPostingsController@create');
    
//This route is mapped to the '/updateJobPostingsView' URI and will read the job postings data
Route::get('/updateJobPostingsView', 'JobPostingsController@readByJobID');
    
//The route is mapped to the '/updatedSkillsView' and will update the skill data
Route::post('/updatedJobPostingsView', 'JobPostingsController@update');
    
//The route is mapped to the '/deleteJobPostingsView' and will get the job id to delete them
Route::get('/deleteJobPostingsView', 'JobPostingsController@delete'); 

//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE JOB POSTINGS (USER INTERACTIONS)

//This route is mapped to the '/allJobsView' URI and will display the page for all the jobs
Route::get('/allJobsView','JobPostingsController@showAll');

//The route is mapped to the '/applyJobView' and will allow the user to apply to the job
Route::get('/applyJobView', 'JobPostingsController@apply');

//The route is mapped to the '/saveJobView' and will allow a user to save a job
Route::get('/saveJobView', 'JobPostingsController@save');

//The route is mapped to the '/jobView' and will display the group page with all the members
Route::get('/jobView', 'JobPostingsController@showIndJob');

//-------------------------------------------------------------------------------------


//ROUTES RELATED TO TESTING THE SESSION VARIABLES 

//this route wil output the session variables
Route::get('session/get','SessionController@accessSessionData');


//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE GROUPS (ADMIN INTERACTIONS)

//This route is mapped to the '/groupsView' URI and will display the page for a individual group
//Route::get('/groupsView','GroupsController@index');

//This route is mapped to the '/adminPageOfGroupsView' URI and will display the page that allows the admin to perform admin functions
Route::get('/adminPageOfGroupsView', 'GroupsController@readAll');

//This route is mapped to the '/addGroupsView' URI and will display the page that allows the admins at enter new groups
Route::get('/addGroupsView', function(){
    return view('addGroupsView');
});
    
//The route is mapped to the '/addedGroupsView' and will post the admin input from the groups view
Route::post('/addedGroupsView', 'GroupsController@create');
    
//This route is mapped to the '/updateGroupsView' URI and will read the job postings data
Route::get('/updateGroupsView', 'GroupsController@readByGroupId');
    
//The route is mapped to the '/updatedGroupsView' and will update the skill data
Route::post('/updatedGroupsView', 'GroupsController@update');
    
//The route is mapped to the '/deleteGroupsView' and will get the job id to delete them
Route::get('/deleteGroupsView', 'GroupsController@delete');
    
//-------------------------------------------------------------------------------------

//ROUTES RELATED TO THE GROUPS (USER INTERACTIONS)

//This route is mapped to the '/allGroupsView' URI and will display the page for all the groups
Route::get('/allGroupsView','GroupsController@userReadAll');
    
//The route is mapped to the '/joinGroupView' and will add a user to a group
Route::get('/joinGroupView', 'UsersGroupsController@create');
    
//The route is mapped to the '/leaveGroupView' and will delete a user from a group 
Route::get('/leaveGroupView', 'UsersGroupsController@delete');

//The route is mapped to the '/groupMembersView' and will display the group page with all the members
Route::get('/groupView', 'UsersGroupsController@readByGroupId');
    
//-------------------------------------------------------------------------------------

