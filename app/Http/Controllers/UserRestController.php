<?php
//Almicke Navarro
//4-3-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to the user
namespace App\Http\Controllers;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\BusinessServices\PersonalInformationBusinessService;
use App\Services\BusinessServices\EducationBusinessService;
use App\Services\BusinessServices\WorkExperienceBusinessService;
use App\Services\BusinessServices\SkillsBusinessService;
use App\Services\BusinessServices\UserBusinessService;
use App\Services\BusinessServices\UsersGroupsBusinessService;
use App\Services\BusinessServices\UsersJobPostingsBusinessService;
use App\Models\DTO;

class UserRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    //method to output any user information to the browser by using the user id 
    public function show($id)
    {
        try{
                //find the personal info data to pass onto the views
                $pbs = new PersonalInformationBusinessService();
                
                //find the personal info by the user id
                $pi = $pbs->readByUserID($id);
                
                //create a new instance of the EducationBusinessService
                $ebs = new EducationBusinessService();
                
                //find the education by the user id
                $edu = $ebs->readByUserID($id);
                
                //create a new instance of the WorkExperienceBusinessService
                $wbs = new WorkExperienceBusinessService();
                
                //find the work experience by the user id
                $work = $wbs->readByUserID($id);
                
                //create a new instance of the SkillsBusinessService
                $sbs = new SkillsBusinessService();
                
                //find the skill by the user id
                $skills = $sbs->readByUserID($id);
                
                //create a new instance of the UserBusinessService
                $ubs = new UserBusinessService();
                
                //find the user object by its id
                $user = $ubs->readByUserId($id);
                
                //Create a new business service
                $ugbs = new UsersGroupsBusinessService();
                
                //create a variable to hold the user groups stuff
                $usergroups = $ugbs->readByUserID($id);
                
                //create new jobs business services
                $ujbs = new UsersJobPostingsBusinessService();
                
                //create variables to hold the saved and applied jobs
                $savedjobs = $ujbs->readSaved($id);
                $appliedjobs = $ujbs->readApplied($id);
                
                
            //check if the user was found
            if ($user != null) { 
                
                //find the user's first and last name
                $firstname = $user->getFirstName();
                $lastname = $user->getLastname();
                
                //compress all the user data into a single array
                $Data = [
                    'First_Name' => $firstname,
                    'Last_Name' => $lastname,
                    'Personal_Info' => $pi,
                    'Education' => $edu,
                    'Work' => $work,
                    'Skills' => $skills,
                    'User_Groups' => $usergroups,
                    'Saved_Jobs' => $savedjobs,
                    'Applied_Jobs' => $appliedjobs
                ];
                
                    
                //create a DTO
                $dto = new DTO(0, "OK", $Data);
                
            } else { 
                //create a DTO
                $dto = new DTO(-1, "User Not Found", "");
                
            }
            
            //serialie the DTO to JSON
            $json = json_encode($dto);
            
            //retun JSON back to caller
            return $json;
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $dto = new DTO(-2, $e->getMessage(), "");
            return json_encode($dto);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
