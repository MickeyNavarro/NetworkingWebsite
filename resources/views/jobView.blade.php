<!-- 
//Almicke Navarro 
//2-22-19
//Networking Milestone
//This is my own work.
//The form that allows users to add view a job posting
-->
 
@extends('layouts.appmaster')
@section('title', 'Job Posting Page')
  
@section('content')
<h3 class = "heading1">{{$job->getName()}}</h3>
<h4>Company: {{$job->getCompany()}}</h4>
			
<hr>
			
<p>Pay: {{$job->getPay()}}</p>
            
<p>Description: {{$job->getDescription()}}</p>

<form action = 'saveJobView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$job->getId()}}><input type = 'submit' value = 'Save'></form>
<form action = 'applyJobView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$job->getId()}}><input type = 'submit' value = 'Apply'></form>

@endsection
