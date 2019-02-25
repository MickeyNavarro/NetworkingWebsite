<!-- 
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//The form that allows users to edit their education
-->

@extends('layouts.appmaster')
@section('title', 'Update Education Page')
  
@section('content')

    <form action = "updatedEducationView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Update Education</h3>
			<hr>
			
            <label>School</label>
            <input type="text" value = '{{$edu->getSchool()}}' name="school">
                          
            <label>Degree</label>
            <input type="text" value = '{{$edu->getDegree()}}' name="degree">  
            
            <label>Start Year</label>
            <input type="text" value = '{{$edu->getStart_year()}}' name="startYear">    
            
            <label>End Year</label>
            <input type="text" value = '{{$edu->getEnd_year()}}' name="endYear"> 
			
			<label>Additional Information</label>
            <input type="text" value = '{{$edu->getAdditional_info()}}' name="additionalInfo"> 
            
            <input type = 'hidden' name = 'id' value = '{{$edu->getId()}}'> 
            
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

