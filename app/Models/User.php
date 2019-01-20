<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//Handles all the information taken from the user.

namespace App\Models;

class User
{
    private $id;
    private $firstName;
    private $lastname;
    private $email;
    private $username;
    private $password;
    private $role;
    
    //Constuctor
    public function __construct($id, $first, $last, $email, $username, $password, $role){
        
        $this->id = $id;
        $this->firstName = $first;
        $this->lastname = $last;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
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
      
}
    