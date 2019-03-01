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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getSuspend()
    {
        return $this->suspend;
    }

    


}
    