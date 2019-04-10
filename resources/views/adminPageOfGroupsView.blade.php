<!--
//Almicke Navarro
//3-1-19
//Networking Milestone
//This is my own work.
//The form that allows admins to view, edit, or delete groups
-->

@extends('layouts.appmaster')
@section('title', 'Groups Admin Page')
  
@section('content')
@if (session()->get('role') == 1)
   
    <h3 class = "heading1">List of Groups</h3>
    <hr> 
    @if ($groups != null)
    <table id = groups class = "darkTable table-hover"> 
    <thead>	
        <th>ID</th>
        <th>Name </th>
        <th>Description</th>
    	<th></th>
    	<th></th>
    </thead>
    <tbody>

    <!-- Loop to show all the groups from the database -->
    @for ($x = 0; $x < count($groups); $x++) 
        <tr>
        <td>{{$groups[$x]['ID']}}</td>
        <td> {{$groups[$x]['GROUP_NAME']}} </td>
        <td> {{$groups[$x]['DESCRIPTION']}} </td>
     
        <!-- include buttons for edit and delete a group -->
        <td><form action = 'updateGroupsView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$groups[$x]['ID']}}><input type = 'submit' value = 'Edit'></form> </td>
        <td><form action = 'deleteGroupsView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$groups[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
        
        </tr>
   
    @endfor
    </tbody>
	</table>
	@else 
	<h4>Sorry, there are no groups!</h4>
	@endif
<script type="text/javascript">
$(document).ready( function () {
    $('#groups').DataTable();
} );
</script>
            	
@else 
<h4>Sorry, you must be an Admin to view this page!</h4>
@endif 
@endsection