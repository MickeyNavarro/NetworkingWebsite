<?php
namespace Models;

class SkillsModel
{
    private $id;
    private $skill_name;
    private $userid; 
    
    //Constuctor
    public function __construct($id, $skill_name, $userid){
        $this->id = $id;
        $this->skill_name = $skill_name;
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
    public function getSkill_name()
    {
        return $this->skill_name;
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
    public function setSkill_name($skill_name)
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

