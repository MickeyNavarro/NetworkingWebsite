<!--
//Mariah Valenzuela and Almicke Navarro
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add their education
-->
@extends('layouts.appmaster')
@section('title', 'Add Work Experience Page')
  
@section('content')

<div class = "add-information-form">
    <form action = "workExperienceView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Add Experience</h3>
			<hr>
			
            <label>Position Title</label>
            <input type="text" placeholder="Enter Position Title" name="position">
                          
            <label>Company</label>
            <input type="text" placeholder="Enter Company" name="company">  
            
            <label>Location</label>
            <input type="text" placeholder="Enter Location" name="location">  
            
            <label>Start Year</label>
            <input type="text" placeholder="Enter Start Year" name="startYear">    
            
            <label>End Year</label>
            <input type="text" placeholder="Enter End Year" name="endYear"> 
			
			<label>Additional Information</label>
            <input type="text" placeholder="Enter Additional Information" name="additionalInfo">  
            
            <button type="submit" class="loginbtn submit-info-button ">Submit</button>
            
            <!-- Cancel Button -->
            <div class="cancel-button">
            <a href="viewProfile">Cancel</a>
        	</div>
    </form>
</div>

@endsection
        	