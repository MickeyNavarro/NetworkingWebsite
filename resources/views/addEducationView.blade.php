<!-- 
//Mariah Valenzuela and Almicke Navarro
//2-1-19
//Networking Milestone
//This is my own work.
//The form that allows users to add their education
-->

@extends('layouts.appmaster')
@section('title', 'Add Education Page')
  
@section('content')
    <form action = "addedEducationView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Add Education</h3>
			<hr>
			
            <label>School</label>
            <input type="text" placeholder="Enter School" name="school">
                          
            <label>Degree</label>
            <input type="text" placeholder="Enter Degree" name="degree">  
            
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
    <!-- Output list of errors, if any-->
	@if($errors->count() != 0)
		@foreach($errors->all() as $message)
			{{$message}} <br/> 
		@endforeach 
	@endif    
@endsection

