<!--
//Almicke Navarro
//3-3-19
//Networking Milestone
//This is my own work.
//The form that allows users to view, leave, and join a singular group
-->

@extends('layouts.appmaster')
@section('title', 'Group Page')
  
@section('content')

@if(session()->has('role'))
    @if ($groupdata != null)
<div class = "group-profile">
    <h2 class = "heading1"></h2>
    <hr> 
    <table id = groups class = "darkTable table-hover"> 
    <thead>	
        <th>Members</th>
    </thead>
    <tbody>

    <!-- Loop to show all the groups from the database -->
        <tr>
        <td>{{$groupdata['ID']}}</td>
        <td> {{$groupdata['GROUP_NAME']}} </td>
        <td> {{$groupdata['DESCRIPTION']}} </td>
        
        </tr>
   
    </tbody>
	</table>
	@else 
	<h4>Sorry, there are no groups!</h4>
	@endif
</div>

@else 
<h4>Sorry, you must login to view this page!</h4>
@endif 
<script type="text/javascript">
$(document).ready( function () {
    $('#groups').DataTable();
} );
</script>
            	

@endsection