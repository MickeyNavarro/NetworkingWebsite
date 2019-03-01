<?php

//Almicke Navarro
//2-2-19
//Networking Website
//This is my own work.
//Handles all the information taken from the Work Experience class.

namespace App\Models;

class WorkExperienceModel
{
    private $id;
    private $position;
    private $company;
    private $start_year;
    private $end_year;
    private $additional_info;
    private $userid; 
    
    //Constuctor
    public function __construct($id, $position, $company, $start_year, $end_year, $additional_info, $userid){
        $this->id = $id;
        $this->position = $position;
        $this->company = $company;
        $this->start_year = $start_year;
        $this->end_year = $end_year;
        $this->additional_info = $additional_info;
        $this->userid = $userid; 
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
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getStart_year()
    {
        return $this->start_year;
    }

    /**
     * @return mixed
     */
    public function getEnd_year()
    {
        return $this->end_year;
    }

    /**
     * @return mixed
     */
    public function getAdditional_info()
    {
        return $this->additional_info;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }


}