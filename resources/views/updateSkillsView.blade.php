<!--
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//The form that allows users to update their skill
-->

@extends('layouts.appmaster')
@section('title', 'Update Skill Page')
  
@section('content')

    <form action = "updatedSkillsView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
			<h3 class = "heading1">Update Skill</h3>
			<hr>
			
            <label>Skill</label>
            <input type="text" value = '{{$skills->getSkills_name()}}' name="skill">
            
            <input type = 'hidden' name = 'id' value = '{{$skills->getId()}}'> 
            
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