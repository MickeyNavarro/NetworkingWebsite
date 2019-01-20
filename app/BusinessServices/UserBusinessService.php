<?php

//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//interacts with the User class data with business specifications

namespace App\BusinessServices;

use App\DataServices\UserdataService;

class UserBusinessService{
    
    function createNewUser($person){
        $dbService = new UserDataService();
        return $dbService->createNewUser($person);
    }
    
    
    function login($username, $password){
        $dbService = new UserdataService();
        return $dbService->login($username, $password);
    }
      
}