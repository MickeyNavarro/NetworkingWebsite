<!-- 
//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The registration form
 -->
 
@extends('layouts.appmaster')
@section('title', 'Registration Page')
  
@section('content')
<div class = form>
    <form action = "registrationView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
            <h1>Create an Account</h1>
            <hr>
            
            <label>First Name</label>
            <input type="text" placeholder="Enter First Name" name="firstname">
            
            <label>Last Name</label>
            <input type="text" placeholder="Enter Last Name" name="lastname">
            
            
            <label>Username</label>
            <input type="text" placeholder="Enter Username" name="username">
            
            <label>Email</label>
            <input type="text" placeholder="Enter Email" name="email">
            
            
            <label>Password</label>
            <input type="password" placeholder="Enter Password" name="password">    
            
            <button type="submit" class="registerbtn">Register</button>    
            
            <div class="signin">
            <label >Already have an account? <a href="login">Sign in</a>.</label>
        </div>
    </form>
</div>
<!-- Output list of errors, if any-->
	@if($errors->count() != 0)
		@foreach($errors->all() as $message)
			{{$message}} <br/> 
		@endforeach 
	@endif
@endsection