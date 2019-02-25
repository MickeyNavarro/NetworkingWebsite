<?php

//Almicke Navarro
//1-19-19
//Networking Website
//This is my own work.
//Handles all the information taken from the user.

namespace App\Models;

class UsersModel
{
    private $id;
    private $firstName;
    private $lastname;
    private $email;
    private $username;
    private $password;
    private $role;
    private $suspend; 
    
    //Constuctor
    public function __construct($id, $firstname, $lastname, $email, $username, $password, $role, $suspend){
        $this->id = $id;
        $this->firstName = $firstname; 
        $this->lastname = $lastname;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role; 
        $this->suspend = $suspend; 
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    public function getLastname()
    {
        return $this->lastname;
    }     
    
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getPassword()
    {
        return $this->password;
    } 
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
     
    public function getRole()
    {
        return $this->role;
    }
    
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    /**
     * @return mixed
     */
    public function getSuspend()
    {
        return $this->suspend;
    }

    /**
     * @param mixed $suspend
     */
    public function setSuspend($suspend)
    {
        $this->suspend = $suspend;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
      
}
    