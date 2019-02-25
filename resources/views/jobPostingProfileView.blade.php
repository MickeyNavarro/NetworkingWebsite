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
<div class = user-profile>

			<h3 class = "heading1">{{$job->getName()}}</h3>
			<h4>Company: {{$job->getCompany()}}</h4>
			
			<hr>
			
            <h5>Pay: {{$job->getPay()}}</h5>
            
            <hr> 
            
            <h5>{{$job->getDescription()}}</h5>
</div>

 @endsection
