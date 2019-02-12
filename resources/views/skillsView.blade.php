<!--
//Mariah Valenzuela and Almicke Navarro
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add their education
-->

@extends('layouts.appmaster')
@section('title', 'Add Skill Page')
  
@section('content')

<div class = "add-information-form">
    <form action = "skillsView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Add Skill</h3>
			<hr>
			
            <label>Skill</label>
            <input type="text" placeholder="Enter Skill" name="skill">
                        
         	<button type="submit" class="loginbtn submit-info-button ">Submit</button>
            
            <!-- Cancel Button -->
            <div class="cancel-button">
            <a href="viewProfile">Cancel</a>
        	</div>
    </form>
</div>

@endsection