<!-- 
//Almicke Navarro 
//4-7-19
//Networking Milestone
//This is my own work.
//This page outputs any error messages 
-->
 
@extends('layouts.appmaster')
@section('title', 'Error Page')
  
@section('content')
<h4>{{$errorMessage}}</h4>

@endsection
