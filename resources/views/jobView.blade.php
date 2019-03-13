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
            
<hr> 
            
<p>Description: {{$job->getDescription()}}</p>

@endsection
