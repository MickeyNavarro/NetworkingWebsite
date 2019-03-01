<?php
//Almicke Navarro
//2-21-19
//Networking Website
//This is my own work.
//Handles all the information taken from the user job postings class.

namespace App\Models;

class UsersJobPostingsModel
{
    private $id;
    private $save; 
    private $apply; 
    private $job_postings_id;
    
    public function _construct($id, $save, $apply, $users_id, $job_postings_id){
        $this->id = $id;
        $this->save = $save; 
        $this->apply = $apply; 
        $this->users_id = $users_id;
        $this->job_postings_id = $job_postings_id; 
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSave()
    {
        return $this->save;
    }

    /**
     * @return mixed
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * @return mixed
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * @return mixed
     */
    public function getJob_postings_id()
    {
        return $this->job_postings_id;
    }

    
    
}

