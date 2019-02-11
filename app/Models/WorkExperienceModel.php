<?php
namespace Models;

class WorkExperienceModel
{
    private $id;
    private $position;
    private $company;
    private $location; 
    private $start_year;
    private $end_year;
    private $additional_info;
    private $userid; 
    
    //Constuctor
    public function __construct($id, $position, $company, $location, $start_year, $end_year, $additional_info, $userid){
        $this->id = $id;
        $this->position = $position;
        $this->company = $company;
        $this->location = $location; 
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param mixed $start_year
     */
    public function setStart_year($start_year)
    {
        $this->start_year = $start_year;
    }

    /**
     * @param mixed $end_year
     */
    public function setEnd_year($end_year)
    {
        $this->end_year = $end_year;
    }

    /**
     * @param mixed $additional_info
     */
    public function setAdditional_info($additional_info)
    {
        $this->additional_info = $additional_info;
    }
    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }
    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }



    
    
}

