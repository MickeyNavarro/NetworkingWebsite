<!--
//Almicke Navarro
//2-10-19
//Networking Milestone
//This is my own work.
//The admin form to edit a user

//this form is not in currently in use
-->

@extends('layouts.appmaster')
@section('title', 'Login Page')

@section('content')
<div class = form>
<form action = "" method = "POST">
<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
<h1>Edit User</h1>
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
<input type="password" placeholder="Enter Password" name="pass">

<button type="submit" class="registerbtn">Register</button>

<div class="signin">
<label><a href="#">Cancel</a>.</label>
</div>
</form>
</div>

@endsection