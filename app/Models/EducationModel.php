<?php
namespace App\Models;

class EducationModel
{
    private $id;
    private $school;
    private $degree;
    private $start_year;
    private $end_year;
    private $additional_info;
    private $userid;
    
    //Constuctor
    public function __construct($id, $school, $degree, $start_year, $end_year, $additional_info, $userid){
        $this->id = $id;
        $this->school = $school;
        $this->degree = $degree;
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
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @return mixed
     */
    public function getDegree()
    {
        return $this->degree;
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
     * @param mixed $school
     */
    public function setSchool($school)
    {
        $this->school = $school;
    }

    /**
     * @param mixed $degree
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;
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


    
    
}

