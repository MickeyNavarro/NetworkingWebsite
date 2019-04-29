<!-- 
//Almicke Navarro (and Mariah Valenzuela)
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add view, add, and edit their profile
-->
 
<!DOCTYPE html>
<html lang = "en">
    <head>
    	<title>User Profile</title>
    	
        <!-- Font -->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <!-- Side Panel -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    
        <!-- My Stylesheet -->
        <link rel="stylesheet" type="text/css" href="/NetworkingMilestone/public/css/styles.css" />    
            
</head> 
  
<body>
<div class ="everything">
    @include('layouts.sidepanel')

    <div class = "top">   
    	<nav class="navbar">
        	<div>
			<button class="openbtn" style = "font-family: 'Fjalla One', sans-serif;" onclick="openNav()">&#9776;</button> 
			
            </div>
            <div>
            	<h1>{{$firstname}} {{$lastname}}'s Profile</h1>
            </div>		
    	</nav>
    </div>
    
    <div class = "main">
    <div class = "user-profile">
    <!-- check if the session variable holds the user id -->
@if (session()->has('userid'))

	<div id = "user-photo" class="column"> 		
		<img id = "photo" src="https://cdn3.iconfinder.com/data/icons/business-and-finance-icons/512/Business_Man-512.png" alt="User Photo" >   	
	</div>
    <div id = "user-personal-information" class = "column">
          
        <!-- check if the first and last name was passed on from the controller -->      
        @if ($firstname !=null && $lastname != null)
        <h2>{{$firstname}} {{$lastname}}</h2>
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
    		 <form class = "add-info-button" action="{{url('/')}}/addPersonalInformation" >
			<input title="Add Personal Information" class = "plus-image" type="image" src="https://image.flaticon.com/icons/svg/109/109526.svg" alt="Submit" width="48" height="48">
		
			</form>
			@if ($pi != null)
			<form action = "{{url('/')}}/updatePersonalInformationView" method = 'POST'><input type = 'hidden' name = 'id' value = {{$pi->getId()}}><button type="submit" class="btn">Edit</button></form>
            <form action = "{{url('/')}}/deletePersonalInformationView" method = 'GET'><input type = 'hidden' name = 'id' value = {{$pi->getId()}}><button type="submit" class="btn">Delete</button></form>
            @endif
    </div>
        
 	<hr>  
   	
   	<div id = "user-information">	
 	<!-- User Education -->
 	<div id = "user-education"> 		
 		<h4 class = "heading column">Education</h4>
 		<br>
 		<br>
 		@if ($edu != null)
 		<!-- @for ($x = 0; $x < count($edu); $x++) 
 		<div class= "section">
 		<h5>{{$edu[$x]['SCHOOL']}}</h5> <form action = "{{url('/')}}/updateEducationView" method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><input type = 'submit' value = 'Edit'></form><form action = 'deleteEducationView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><input type = 'submit' value = 'Delete'></form>
 		<p>{{$edu[$x]['DEGREE']}}</p>
 		<p>{{$edu[$x]['START_YEAR']}} - {{$edu[$x]['END_YEAR']}} </p>
 		<p>Additional Info: {{$edu[$x]['ADDITIONAL_INFORMATION']}} </p>
 		</div> 
 		@endfor -->
 		
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
     		
     		<td><form action = "{{url('/')}}/updateEducationView" method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><button type="submit" class="btn">Edit</button></form> </td>
            <td><form action = "{{url('/')}}/deleteEducationView" method = 'GET'><input type = 'hidden' name = 'id' value = {{$edu[$x]['ID']}}><button type="submit" class="btn">Delete</button></form> </td>
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="{{url('/')}}/addEducationView">
    			<input title="Add Education" class = "plus-image" type="image" src="https://image.flaticon.com/icons/svg/109/109526.svg" alt="Submit" width="48" height="48">
    		</form>
   		</div> 	 	
 	</div>
 	<br>
 	<br>
 	<hr>  
   	 	
 	<!-- User Work Experience -->
 	<div id = "user-experience"> 		
 		<h4 class = "heading column">Experience</h4>
 		<br>
 		<br>
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
     		
     		<td><form action = "{{url('/')}}/updateWorkExperienceView" method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$work[$x]['ID']}}><button type="submit" class="btn">Edit</button></form> </td>
            <td><form action = "{{url('/')}}/deleteWorkExperienceView" method = 'GET'><input type = 'hidden' name = 'id' value = {{$work[$x]['ID']}}><button type="submit" class="btn">Delete</button></form> </td>
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif 
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="{{url('/')}}/addWorkExperienceView">
				<input title="Add Work Experience" class = "plus-image" type="image" src="https://image.flaticon.com/icons/svg/109/109526.svg" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>
   	<br>
   	<br>	 	
 	<hr>  
   	 	
 	<!-- User Skills -->
 	<div id = "user-skills"> 	
 		<h4 class = "heading column">Skills</h4>
 		<br>
 		<br>
 		 @if ($skills != null)
 		<table id = skills class = "darkTable table-hover"> 
        	<thead>	
                <th>List of Skills</th>
        	</thead>
    	<tbody>
     		@for ($x = 0; $x < count($skills); $x++) 
     		<tr>
     		<td>{{$skills[$x]['SKILLS_NAME']}}</td>
     		
     		<td><form action = "{{url('/')}}/updateSkillsView" method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$skills[$x]['ID']}}><button type="submit" class="btn">Edit</button></form> </td>
            <td><form action = "{{url('/')}}/deleteSkillsView" method = 'GET'><input type = 'hidden' name = 'id' value = {{$skills[$x]['ID']}}><button type="submit" class="btn">Delete</button></form> </td>
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@endif 
 		
 		<div class = "edit-form-button column">
    		<form class = "add-info-button" action="{{url('/')}}/addSkillsView">
				<input title="Add Skills" class = "plus-image" type="image" src="https://image.flaticon.com/icons/svg/109/109526.svg" alt="Submit" width="48" height="48">
			</form>
   		</div>	 	
 	</div>   
 	</div> 
 	</div>
<div class ="user-groups">	 		
@include('userGroupsView')
</div>

<div class = "user-jobs">
<h5>Job(s)</h5>
@include('userSavedJobsView')
@include('userAppliedJobsView')
</div>


 @endif
</div>
</body>
</html>