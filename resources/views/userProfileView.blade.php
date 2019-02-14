<?php
use App\Services\BusinessServices\MemberProfileBusinessService;
?>
<!-- 
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
use App\Services\DataServices\MemberProfileDataService; 

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
        
        //create a new instance of the MemberProfileBusinessService 
        	//there are multiple MemberProfileBusinessService because I plan to change the names of the business services to an entity name
 		$pbs = new MemberProfileBusinessService(); 
 		
 		//find the skills by the user id 
 		$pi = $pbs->findPersonalInfo($id); 
        @endphp
        
        
        <!-- check if a user was returned -->
        @if ($user != null)
        
        <!-- use the id to get the user data from the tables to output onto their member profiles -->
        <h4>{{$user->getFirstName()}} {{$user->getLastName()}}</h4>
        
            @if ($pi != null)
        	<p>{{$pi->getLocation()}}</p>
        	<p>{{$pi->getBiography()}}</p>
        	<div id = "contact-information-button">
        		<a href="#">{{$pi->getContact_email()}}</a>
        	</div>
        	<div id = "contact-information-button">
        		<a href="#">{{$pi->getPhone_number()}}</a>
        	</div>
        	@else 
        	<p>Click the plus icon to the right to add your information!</p>
        	@endif
    	@endif
    	
    @else 
        <!-- TODO: reroute to an error page  -->
    @endif
    	
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
 		
 		@php
 		//create a new instance of the MemberProfileBusinessService 
 		$ebs = new MemberProfileBusinessService(); 
 		
 		//find the skills by the user id 
 		$edu = $ebs->findEducation($id); 
 		@endphp
 		
 		 @if ($edu != null)
 		<table id = work class = "darkTable table-hover"> 
        	<thead>	
               <th>School</th>
               <th>Degree</th>
               <th>Start Year</th>
               <th>End Year</th>
               <th>Additional Info</th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($edu); $x++) 
     		<tr>
     		<td>{{$edu[$x]['SCHOOL']}}</td>
     		<td>{{$edu[$x]['DEGREE']}}</td>
     		<td>{{$edu[$x]['START_YEAR']}}</td>
     		<td>{{$edu[$x]['END_YEAR']}}</td>
     		<td>{{$edu[$x]['ADDITIONAL_INFO']}}</td>
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addEducationView">
    			<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
    		</form>
   		</div> 	 	
 	</div>
 	<br>
 	<br>
 	<hr>  
   	 	
 	<!-- User Experience -->
 	<div id = "user-experience"> 		
 		<h4 class = "heading column">Experience</h4>
 		
 		@php
 		//create a new instance of the MemberProfileBusinessService 
 		$wbs = new MemberProfileBusinessService(); 
 		
 		//find the skills by the user id 
 		$work = $wbs->findWork($id); 
 		@endphp
 		
 		 @if ($work != null)
 		<table id = work class = "darkTable table-hover"> 
        	<thead>	
               <th>Position</th>
               <th>Company</th>
               <th>Location</th>
               <th>Start Year</th>
               <th>End Year</th>
               <th>Additional Info</th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($work); $x++) 
     		<tr>
     		<td>{{$work[$x]['POSITION']}}</td>
     		<td>{{$work[$x]['COMPANY']}}</td>
     		<td>{{$work[$x]['LOCATION']}}</td>
     		<td>{{$work[$x]['START_YEAR']}}</td>
     		<td>{{$work[$x]['END_YEAR']}}</td>
     		<td>{{$work[$x]['ADDITIONAL_INFORMATION']}}</td>
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif 
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addWorkExperienceView">
				<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>
   	<br>
   	<br>	 	
 	<hr>  
   	 	
 	<!-- User Skills -->
 	<div id = "user-skills"> 	
 		<h4 class = "heading column">Skills</h4>
 		
 		@php
 		//create a new instance of the MemberProfileBusinessService 
 		$sbs = new MemberProfileBusinessService(); 
 		
 		//find the skills by the user id 
 		$skills = $sbs->findSkill($id); 
 		@endphp
 		
 		 @if ($skills != null)
 		<table id = skills class = "darkTable table-hover"> 
        	<thead>	
                <th>List of Skills</th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($skills); $x++) 
     		<tr><td>{{$skills[$x]['SKILL_NAME']}}</td></tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif 
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addSkillView">
				<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>   	 		
 </div>
 
 @endsection
