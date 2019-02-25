<?php
//Almicke Navarro
//2-23-19
//Networking Website
//This is my own work.
//Handles all the information taken from the Job Postings class.
namespace App\Models;

class JobPostingsModel
{
    private $id; 
    private $name; 
    private $company; 
    private $pay; 
    private $description; 
    //private $addresses_id; 
    
    //Constuctor
    public function __construct($id, $name, $company, $pay, $description){
        $this->id = $id;
        $this->name = $name;
        $this->company = $company; 
        $this->pay = $pay; 
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getPay()
    {
        return $this->pay;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    } 
    
}

