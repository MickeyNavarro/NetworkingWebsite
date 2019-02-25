<!--
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//The form that allows users to update their work experience
-->
@extends('layouts.appmaster')
@section('title', 'Update Work Experience Page')
  
@section('content')

    <form action = "updatedWorkExperienceView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Update Work Experience</h3>
			<hr>
			
            <label>Position Title</label>
            <input type="text" value = '{{$work->getPosition()}}' name="position">
                          
            <label>Company</label>
            <input type="text" value = '{{$work->getCompany()}}' name="company">  
            
            <label>Start Year</label>
            <input type="text" value = '{{$work->getStart_year()}}' name="startYear">    
            
            <label>End Year</label>
            <input type="text" value = '{{$work->getEnd_year()}}' name="endYear"> 
			
			<label>Additional Information</label>
            <input type="text" value = '{{$work->getAdditional_info()}}' name="additionalInfo">  
            
            <input type = 'hidden' name = 'id' value = '{{$work->getId()}}'> 
            
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