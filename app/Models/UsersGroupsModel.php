<?php
//Almicke Navarro
//2-21-19
//Networking Website
//This is my own work.
//Handles all the information taken from the user groups class.

namespace App\Models;

class UsersGroupsModel
{
    private $id; 
    private $user_id; 
    private $groups_id; 
    
    public function _construct($id, $user_id, $groups_id){
        $this->id = $id; 
        $this->user_id = $user_id; 
        $this->groups_id = $groups_id; 
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
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getGroups_id()
    {
        return $this->groups_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $groups_id
     */
    public function setGroups_id($groups_id)
    {
        $this->groups_id = $groups_id;
    }

    
    
}

