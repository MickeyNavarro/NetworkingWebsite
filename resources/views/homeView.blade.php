<!-- 
//Almicke Navarro 
//3-2-19
//Networking Milestone
//This is my own work.
//This page displays the home page 
-->
 
@extends('layouts.appmaster')
@section('title', 'Home Page')
  
@section('content')
<div class = home>

<h1>Welcome to Networking.com</h1>
<p>This is some networking site that I will name and fix the CSS on soon.</p>

</div>
<!-- check if the session variable holds the user id -->
@if (session()->has('userid'))
@endif 
@endsection