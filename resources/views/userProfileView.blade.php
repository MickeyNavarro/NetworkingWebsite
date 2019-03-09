<!-- 
//Almicke Navarro (and Mariah Valenzuela)
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add view, add, and edit their profile
-->
 
@extends('layouts.appmaster')
@section('title', 'User Profile')
  
@section('content')

<!-- check if the session variable holds the user id -->
@if (session()->has('userid'))

	<div id = "user-photo" class="column"> 		
		<img id = "photo" src="https://cdn3.iconfinder.com/data/icons/business-and-finance-icons/512/Business_Man-512.png" alt="User Photo" >   	
	</div>
    <div id = "user-personal-information" class = "column">
          
        <!-- check if the first and last name was passed on from the controller -->      
        @if ($firstname !=null && $lastname != null)
        <h3>{{$firstname}} {{$lastname}}</h3>
        @else 
        <h4>Something went wrong</h4>
        @endif
        
        
        <!-- check if the personal info data was passed on from the controller -->              
        @if ($pi != null)
            <p>{{$pi->getCurrent_position()}}</p>
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
    	
    </div>
    <div class = "edit-form-button column">
    		 <form class = "add-info-button" action="addPersonalInformation">
			<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
		
			</form>
			@if ($pi != null)
			<form action = 'updatePersonalInformationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$pi->getId()}}><input type = 'submit' value = 'Edit'></form>
            <form action = 'deletePersonalInformationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$pi->getId()}}><input type = 'submit' value = 'Delete'></form>
            @endif
    </div>
        
 	<hr>  
   	 	
 	<!-- User Education -->
 	<div id = "user-education"> 		
 		<h4 class = "heading column">Education</h4>
 		<br>
 		<br>
 		<br>
 		@for ($x = 0; $x < count($edu); $x++) 
 		<div class= "section">
 		<h5>{{$edu[$x]['SCHOOL']}}</h5> <form action = 'updateEducationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><input type = 'submit' value = 'Edit'></form><form action = 'deleteEducationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><input type = 'submit' value = 'Delete'></form>
 		<p>{{$edu[$x]['DEGREE']}}</p>
 		<p>{{$edu[$x]['START_YEAR']}} - {{$edu[$x]['END_YEAR']}} </p>
 		<p>Additional Info: {{$edu[$x]['ADDITIONAL_INFORMATION']}} </p>
 		</div>
 		@endfor
 		
 		 @if ($edu != null)
 		<table id = work class = "darkTable table-hover"> 
        	<thead>	
               <th>School</th>
               <th>Degree</th>
               <th>Start Year</th>
               <th>End Year</th>
               <th>Additional Info</th>
               <th></th>
    		   <th></th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($edu); $x++) 
     		<tr>
     		<td>{{$edu[$x]['SCHOOL']}}</td>
     		<td>{{$edu[$x]['DEGREE']}}</td>
     		<td>{{$edu[$x]['START_YEAR']}}</td>
     		<td>{{$edu[$x]['END_YEAR']}}</td>
     		<td>{{$edu[$x]['ADDITIONAL_INFORMATION']}}</td>
     		
     		<td><form action = 'updateEducationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><input type = 'submit' value = 'Edit'></form> </td>
            <td><form action = 'deleteEducationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
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
   	 	
 	<!-- User Work Experience -->
 	<div id = "user-experience"> 		
 		<h4 class = "heading column">Experience</h4>
 		
 		@if ($work != null)
 		<table id = work class = "darkTable table-hover"> 
        	<thead>	
               <th>Position</th>
               <th>Company</th>
               <th>Start Year</th>
               <th>End Year</th>
               <th>Additional Info</th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($work); $x++) 
     		<tr>
     		<td>{{$work[$x]['POSITION']}}</td>
     		<td>{{$work[$x]['COMPANY']}}</td>
     		<td>{{$work[$x]['START_YEAR']}}</td>
     		<td>{{$work[$x]['END_YEAR']}}</td>
     		<td>{{$work[$x]['ADDITIONAL_INFORMATION']}}</td>
     		
     		<td><form action = 'updateWorkExperienceView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$work[$x]['ID']}}><input type = 'submit' value = 'Edit'></form> </td>
            <td><form action = 'deleteWorkExperienceView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$work[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
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
 		
 		 @if ($skills != null)
 		<table id = skills class = "darkTable table-hover"> 
        	<thead>	
                <th>List of Skills</th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($skills); $x++) 
     		<tr>
     		<td>{{$skills[$x]['SKILLS_NAME']}}</td>
     		
     		<td><form action = 'updateSkillsView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$skills[$x]['ID']}}><input type = 'submit' value = 'Edit'></form> </td>
            <td><form action = 'deleteSkillsView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$skills[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif 
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="addSkillsView">
				<input class = "plus-image" type="image" src="https://static.thenounproject.com/png/617815-200.png" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>   	 		
@include('userGroupsView')
 @endif
 @endsection
