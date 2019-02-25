<?php

//Almicke Navarro
//2-2-19
//Networking Website
//This is my own work.
//Handles all the information taken from the Personal Information class.
namespace App\Models;

class PersonalInformationModel
{
    private $id; 
    private $biography;
    private $current_position; 
    private $contact_email; 
    private $phone_number;
    private $photo;
    private $userid; 
    //private $addresses_id; 
    
    //Constuctor
    public function __construct($id, $biography, $current_position, $contact_email, $phone_number, $photo, $userid){
        $this->id = $id;
        $this->biography = $biography;
        $this->current_position = $current_position; 
        $this->contact_email = $contact_email;
        $this->phone_number = $phone_number;
        $this->photo = $photo;
        $this->userid = $userid; 
        //$this->addresses_id = $addresses_id; 
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
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @return mixed
     */
    public function getCurrent_position()
    {
        return $this->current_position;
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
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * @param mixed $current_position
     */
    public function setCurrent_position($current_position)
    {
        $this->current_position = $current_position;
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
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }


    
    
}