<!--
//Almicke Navarro
//3-12-19
//Networking Milestone
//This is my own work.
//The form that allows users to view, save, and apply to all jobs
-->

@extends('layouts.appmaster')
@section('title', 'Job(s) Page')
  
@section('content')

@if(session()->has('role'))
    <h3 class = "heading1">Find New Jobs</h3>
    <hr> 
    @if ($jobs != null)
    <table id = jobs class = "darkTable table-hover"> 
    <thead>	
        <th>Position</th>
        <th>Company</th>
    	<th>Pay</th>
    	<th>Description</th>
    	<th>Address</th>
    	<th></th>
    	<th></th>
    </thead>
    <tbody>

    <!-- Loop to show all the jobs from the database -->
    @for ($x = 0; $x < count($jobs); $x++) 
        <tr>   
        <td><form action = 'jobView' method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$jobs[$x]['ID']}}><input type = 'submit' value = '{{$jobs[$x]['NAME']}}'></form> </td>
        <td> {{$jobs[$x]['COMPANY']}} </td>
        <td> {{$jobs[$x]['PAY']}} </td>
        <td> {{$jobs[$x]['DESCRIPTION']}} </td>
        <td> INSERT ADDRESS </td>
        <td><form action = 'saveJobView' method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$jobs[$x]['ID']}}><button type="submit" class="btn">Save</button></form> </td>
        <td><form action = 'applyJobView' method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$jobs[$x]['ID']}}><button type="submit" class="btn">Apply</button></form> </td>
        
        </tr>
   
    @endfor
    </tbody>
	</table>
	@endif
@else 
<h4>Sorry, you must login to view this page!</h4>
@endif 

<script type="text/javascript">
$(document).ready( function () {
    $('#jobs').DataTable();
} );
</script>
            	

@endsection