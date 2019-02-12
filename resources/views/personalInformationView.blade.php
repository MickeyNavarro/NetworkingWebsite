<!-- 
//Mariah Valenzuela and Almicke Navarro
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add their personal info
 -->
 
@extends('layouts.appmaster')
@section('title', 'Add Personal Information Page')
  
@section('content')

<div class = "add-information-form">
    <form action = "personalInformationView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Add Personal Information</h3>
			<hr>
			 <!-- To upload profile picture -->  
			<label>Photo</label>
			<div>
			<input type="file" name="file" id="file"/>
			</div>
			
            <label>Location</label>
            <input type="text" placeholder="Enter Location" name="location">    
            
            <label>Biography</label>
            <input type="text" placeholder="Enter Biography" name="bio">  
              
            <h3 class = "heading1" >Contact Information</h3>
			<hr>
			
			<label>Email</label>
            <input type="text" placeholder="Enter Email" name="email"> 
            
            <label>Phone Number</label>
            <input type="text" placeholder="Enter Phone Number" name="phone">  
            
            <button type="submit" class="loginbtn submit-info-button ">Submit</button>
            
        
            <!-- Cancel Button -->
            <div class="cancel-button">
            <a href="viewProfile">Cancel</a>
        	</div>
    </form>
</div>

@endsection
