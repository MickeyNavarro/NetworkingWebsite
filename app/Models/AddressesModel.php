<?php

//Almicke Navarro
//2-21-19
//Networking Website
//This is my own work.
//Handles all the information taken from the addresses class.

namespace App\Models;

class AddressesModel
{
    private $id;
    private $street_address;
    private $city;
    private $state;
    private $zip_code;
    
    //Constuctor
    public function __construct($id, $street_address, $city, $state, $zip_code){
        $this->id = $id;
        $this->street_address = $street_address;
        $this->city = $city;
        $this->state = $state;
        $this->zip_code = $zip_code;
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
    public function getStreet_address()
    {
        return $this->street_address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getZip_code()
    {
        return $this->zip_code;
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
     * @param mixed $street_name
     */
    public function setStreet_name($street_name)
    {
        $this->street_name = $street_name;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param mixed $zip_code
     */
    public function setZip_code($zip_code)
    {
        $this->zip_code = $zip_code;
    }

    
}