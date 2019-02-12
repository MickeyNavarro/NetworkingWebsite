!-- 
//Mariah Valenzuela and Almicke Navarro
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add view, add, and edit their profile

//editted on 2/12/19 by Mickey Navarro to allow the user to view their data that they include 
 -->
 
@extends('layouts.appmaster')
@section('title', 'Login Page')
  
@section('content')

@php 
use App\Services\BusinessServices\UserBusinessService;
@endphp
<div class = user-profile>
	<div id = "user-photo" class="column"> 		
		<img id = "photo" src="https://cdn3.iconfinder.com/data/icons/business-and-finance-icons/512/Business_Man-512.png" alt="User Photo" >   	
	</div>
    <div id = "user-personal-information" class = "column">
    
    <!-- check if the session variable holds the user id -->
    @if (session()->has('userid'))
        @php 
        //get the user id from the session variable 
        $id = session()->get('userid');
        
        //create a new instance of the UserBusinessService class object
        $bs = new UserBusinessService(); 
        
        //find the user attributes by its id 
        $user = $bs->findById($id); 
        @endphp
        
        
        <!-- check if a user was returned -->
        @if ($user != null)
        
        <!-- use the id to get the user data from the tables to output onto their member profiles -->
        <h4>{{$user->getFirstName()}} {{$user->getLastName()}}</h4>
    	<p>Current Position</p>
    	<p>Location</p>
    	<p>Biography</p>
    	@endif
    	
    @else 
        <!-- TODO: reroute to an exception page  -->
    @endif

    
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
