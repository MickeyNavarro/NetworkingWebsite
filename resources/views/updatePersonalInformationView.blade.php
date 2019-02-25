<!-- 
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//The form that allows users to update their personal info
 -->
 
@extends('layouts.appmaster')
@section('title', 'Update Personal Information Page')
  
@section('content')
    <form action = "updatedPersonalInformationView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Update Personal Information</h3>
			<hr>
			 <!-- To upload profile picture -->  
			<label>Photo</label>
			<div>
			<p>{{$pi->getPhoto()}}</p>
			<input type="file" name="file" id="file"/>
			</div>
			
			<label>Current Position</label>
            <input type="text" value = '{{$pi->getCurrent_position()}}' name="pos">   
            
			<label>Biography</label>
            <input type="text" value = '{{$pi->getBiography()}}' name="bio"> 
            
			<label>Contact Email</label>
            <input type="text" value = '{{$pi->getContact_email()}}' name="email"> 
            
            <label>Phone Number</label>
            <input type="text" value = '{{$pi->getPhone_number()}}' name="phone">  
            
            <button type="submit" class="loginbtn submit-info-button ">Submit</button>
            
            <input type = 'hidden' name = 'id' value = '{{$pi->getId()}}'> 
        
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
