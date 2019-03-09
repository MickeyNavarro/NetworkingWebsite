<!--
//Almicke Navarro
//2-22-19
//Networking Milestone
//This is my own work.
//The form that allows admins to add a new job postings
-->
@extends('layouts.appmaster')
@section('title', 'Add Job Posting Page')
  
@section('content')

    <form action = "addedJobPostingsView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Add Job Posting</h3>
			<hr>
			
            <label>Name/Postition Title</label>
            <input type="text" placeholder="Enter Name / Position Title" name="name">
                          
            <label>Company</label>
            <input type="text" placeholder="Enter Company" name="company">  
            
            <label>Pay</label>
            <input type="text" placeholder="Enter Pay" name="pay">    
            
            <label>Description</label>
            <input type="text" placeholder="Enter Description" name="description"> 
			            
            <button type="submit" class="loginbtn submit-info-button ">Submit</button>
            
            <!-- Cancel Button -->
            <div class="cancel-button">
            <a href="adminPageOfJobsView">Cancel</a>
        	</div>
    </form>
<!-- Output list of errors, if any-->
	@if($errors->count() != 0)
		@foreach($errors->all() as $message)
			{{$message}} <br/> 
		@endforeach 
	@endif
@endsection
        	