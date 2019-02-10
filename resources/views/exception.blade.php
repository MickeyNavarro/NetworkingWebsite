<!-- 
//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The Login form
 -->
 
@extends('layouts.appmaster')
@section('title', 'Login Page')
  
@section('content')

<div class = form>
    <form action = "loginView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
            <h1>Login</h1>
            <hr>

            <label>Username</label>
            <input type="text" placeholder="Enter Username" name="username">
                          
            <label>Password</label>
            <input type="password" placeholder="Enter Password" name="pass">    
            
            <button type="submit" class="loginbtn">Log In</button>

            <div class="noaccount">
            <label>Don't have an account? <a href="registration">Register Now</a>.</label>
        	</div>
    </form>
</div>

@endsection