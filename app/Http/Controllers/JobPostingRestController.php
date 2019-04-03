<?php
//Almicke Navarro
//4-3-19
//Networking Milestone
//This is my own work.
//The controller that handles any actions relating to job posting(s)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BusinessServices\JobPostingsBusinessService;

class JobPostingRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //method to return all job postings
    public function index()
    {
        try{
            //get the user id from the session variable
            $id = session()->get('userid');
            
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //Use the business service object to show all matched jobs in the database
            if($jobs = $jbs->readMatches($id)){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('jobsView')->with($Data);
                
            //Use the business service object to show all the jobs in the database
            }else if($jobs = $jbs->readAll()){
                
                //compress all the users into a single array
                $Data = [ 'jobs' => $jobs ];
                
                //Render a response view of the admin page of jobs and pass on the array of jobs
                return view('jobsView')->with($Data);
                
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
    //method to show an individual job posting
    public function show($id)
    {
        try{
            //Create a new business service
            $jbs = new JobPostingsBusinessService();
            
            //create a variable to hold the job posting stuff
            $job = $jbs->readByJobID($id);
            
            //check if a job posting was returned
            if($job !=null){
                
                //compress the job posting array to be sent to the view
                $data = ['job' => $job];
                
                //Render a response View with success message
                return view('jobView')->with($data);
                
            }else{
                //Render a response view with unsuccessful message
                return view('unsuccessfulView');
            }
        }
        catch (Exception $e){
            Log::error("Exception ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
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
