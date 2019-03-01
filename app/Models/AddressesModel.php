ds<?php

//Almicke Navarro
//2-21-19
//Networking Website
//This is my own work.
//Handles all the information taken from the addresses class.

namespace App\Models;

class AddressesModel
{
    private $id;
    private $city;
    private $state;
    private $country ;
    
    //Constuctor
    public function __construct($id, $city, $state, $country){
        $this->id = $id;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
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
    public function getCountry()
    {
        return $this->country;
    }

   
}