<?php

//Almicke Navarro
//2-2-19
//Networking Milestone
//This is my own work.
//Handles all the information taken from the skills class.

namespace App\Models;

class SkillsModel
{
    private $id;
    private $skills_name;
    private $userid; 
    
    //Constuctor
    public function __construct($id, $skills_name, $userid){
        $this->id = $id;
        $this->skills_name = $skills_name;
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
    public function getSkills_name()
    {
        return $this->skills_name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $skill_name
     */
    public function setSkills_name($skill_name)
    {
        $this->skill_name = $skill_name;
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

