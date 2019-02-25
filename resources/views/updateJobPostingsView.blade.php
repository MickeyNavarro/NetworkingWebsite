<?php
use App\Models\JobPostingsModel;
?>
<!--
//Almicke Navarro
//2-22-19
//Networking Milestone
//This is my own work.
//The form that allows users to edit their job postings
-->
@extends('layouts.appmaster')
@section('title', 'Edit Job Posting Page')
  
@section('content')

    <form action = "updatedJobPostingsView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Edit Job Posting</h3>
			<hr>
			
            <label>Name/Postition Title</label>
            <input type="text" value = '{{$job->getName()}}' name="name">
                          
            <label>Company</label>
            <input type="text" value = '{{$job->getCompany()}}' name="company">  
            
            <label>Pay</label>
            <input type="text" value = '{{$job->getPay()}}' name="pay">    
            
            <label>Description</label>
            <input type="text" value = '{{$job->getDescription()}}' name="description"> 
            
            <input type = 'hidden' name = 'id' value = '{{$job->getId()}}'> 
            
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
        	