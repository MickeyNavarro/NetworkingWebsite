<!-- 
//Mariah Valenzuela and Almicke Navarro
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add view, add, and edit their profile
 -->
 
@extends('layouts.appmaster')
@section('title', 'Login Page')
  
@section('content')

<div class = user-profile>
	<div id = "user-photo" class="column"> 		
		<img id = "photo" src="https://cdn3.iconfinder.com/data/icons/business-and-finance-icons/512/Business_Man-512.png" alt="User Photo" >   	
	</div>
    <div id = "user-personal-information" class = "column">
    	<h4>First Name and Last Name</h4>
    	<p>Current Position</p>
    	<p>Location</p>
    	<p>Biography</p>
    
    	<div id = "contact-information-button">
    		<a href="#">Contact</a>
    	</div>
    </div>
    <div class = "edit-form-button column">
    		 <form class = "add-info-button" action="addPersonalInformation">
			<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
		</form>
    </div>
        
 	<hr>  
   	 	
 	<!-- User Education -->
 	<div id = "user-education"> 		
 		<h4 class = "heading column">Education</h4>
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addEducationView">
    			<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
    		</form>
   		</div> 	 	
 	</div>
 	
 	<hr>  
   	 	
 	<!-- User Experience -->
 	<div id = "user-experience"> 		
 		<h4 class = "heading column">Experience</h4>
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addWorkExperienceView">
				<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>
   	 	
 	<hr>  
   	 	
 	<!-- User Skills -->
 	<div id = "user-skills"> 		
 		<h4 class = "heading column">Skills</h4>
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addSkillView">
				<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>   	 		
 </div>
 
 @endsection
