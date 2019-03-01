<!--
//Almicke Navarro
//3-1-19
//Networking Milestone
//This is my own work.
//The form that allows admins to update groups
-->
@extends('layouts.appmaster')
@section('title', 'Update Group Page')
  
@section('content')

    <form action = "updatedGroupsView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Update Group</h3>
			<hr>
			
            <label>Name</label>
            <input type="text" value = '{{$group->getGroup_name()}}' name="name">
                          
            <label>Description</label>
            <input type="text" value = '{{$group->getDescription()}}' name="description">
            
            <input type = 'hidden' name = 'id' value = '{{$group->getId()}}'> 
			            
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
        	