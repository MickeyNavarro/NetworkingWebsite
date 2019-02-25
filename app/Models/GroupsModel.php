<?php

//Almicke Navarro
//2-21-19
//Networking Website
//This is my own work.
//Handles all the information taken from the groups class.

namespace App\Models;

class GroupsModel
{
    private $id;
    private $group_name;
    
    public function __construct($id, $group_name) { 
        $this->id = $id; 
        $this->group_name = $group_name; 
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
    public function getGroup_name()
    {
        return $this->group_name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $group_name
     */
    public function setGroup_name($group_name)
    {
        $this->group_name = $group_name;
    }

    
    
 
}