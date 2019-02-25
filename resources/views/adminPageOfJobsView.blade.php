<!--
//Almicke Navarro
//2-19-19
//Networking Milestone
//This is my own work.
//The form that allows admins to view, add, edit, or delete job postings
-->

@extends('layouts.appmaster')
@section('title', 'Jobs Admin Page')
  
@section('content')
   
    <h3 class = "heading1">List of Jobs</h3>
    <hr> 
    @if ($jobs != null)
    <table id = jobs class = "darkTable table-hover"> 
    <thead>	
        <th>ID</th>
        <th>Name </th>
        <th>Company</th>
        <th>Pay</th>
        <th>Description</th>
    	<th></th>
    	<th></th>
    	<th></th>
    </thead>
    <tbody>

    <!-- Loop to show all the job postings from the database -->
    @for ($x = 0; $x < count($jobs); $x++) 
        <tr>
        <td>{{$jobs[$x]['ID']}}</td>
        <td> {{$jobs[$x]['NAME']}} </td>
        <td> {{$jobs[$x]['COMPANY']}} </td>
        <td> {{$jobs[$x]['PAY']}} </td>
        <td> {{$jobs[$x]['DESCRIPTION']}} </td>
     
        <!-- include buttons for edit and delete a job posting -->
        <td><form action = 'updateJobPostingsView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$jobs[$x]['ID']}}><input type = 'submit' value = 'Edit'></form> </td>
        <td><form action = 'deleteJobPostingsView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$jobs[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
        
        </tr>
   
    @endfor
    </tbody>
	</table>
	@else 
	<h4>Sorry, there are no job postings!</h4>
	@endif
<script type="text/javascript">
$(document).ready( function () {
    $('#jobs').DataTable();
} );
</script>
            	

@endsection