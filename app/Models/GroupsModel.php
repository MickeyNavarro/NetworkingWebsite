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
    private $description; 
    
    public function __construct($id, $group_name,$description) { 
        $this->id = $id; 
        $this->group_name = $group_name; 
        $this->description = $description; 
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
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }    
 
}