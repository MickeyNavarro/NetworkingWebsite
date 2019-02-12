<?php

//Almicke Navarro
//2-2-19
//Networking Milestone
//This is my own work.
//Handles all the information taken from the Personal Information class.
namespace App\Models;

class PersonalInformationModel
{
    private $id; 
    private $photo; 
    private $location; 
    private $biography; 
    private $contact_email; 
    private $phone_number;
    private $userid; 
    
    //Constuctor
    public function __construct($id, $photo, $location, $biography, $contact_email, $phone_number, $userid){
        $this->id = $id;
        $this->photo = $photo;
        $this->location = $location;
        $this->biography = $biography;
        $this->contact_email = $contact_email;
        $this->phone_number = $phone_number;
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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @return mixed
     */
    public function getContact_email()
    {
        return $this->contact_email;
    }

    /**
     * @return mixed
     */
    public function getPhone_number()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param mixed $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * @param mixed $contact_email
     */
    public function setContact_email($contact_email)
    {
        $this->contact_email = $contact_email;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhone_number($phone_number)
    {
        $this->phone_number = $phone_number;
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

