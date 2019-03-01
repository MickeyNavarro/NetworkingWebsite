<!--
//Almicke Navarro
//3-1-19
//Networking Milestone
//This is my own work.
//The form that allows admins to add a new groups
-->
@extends('layouts.appmaster')
@section('title', 'Add Group Page')
  
@section('content')

    <form action = "addedGroupsView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Add Group</h3>
			<hr>
			
            <label>Name</label>
            <input type="text" placeholder="Enter Name" name="name">
                          
            <label>Description</label>
            <input type="text" placeholder="Enter Description" name="description"> 
			            
            <button type="submit" class="loginbtn submit-info-button ">Submit</button>
            
            <!-- Cancel Button -->
            <div class="cancel-button">
            <a href="adminPageOfGroupsView">Cancel</a>
        	</div>
    </form>
<!-- Output list of errors, if any-->
	@if($errors->count() != 0)
		@foreach($errors->all() as $message)
			{{$message}} <br/> 
		@endforeach 
	@endif
@endsection
        	