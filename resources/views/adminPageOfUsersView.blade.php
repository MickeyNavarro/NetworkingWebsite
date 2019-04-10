<!--
//Almicke Navarro
//2-9-19
//Networking Milestone
//This is my own work.
//The form that allows admins to view, add, edit, or delete users
-->

@extends('layouts.appmaster')
@section('title', 'User Admin Page')
  
@section('content')

@if (session()->get('role') == 1)

    <h3 class = "heading1">List of Users</h3>
    <hr>   
    @if ($users != null)
    <table id = users class = "darkTable table-hover"> 
    <thead>	
        <th>ID</th>
        <th>First Name </th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Role</th>
    	<th>Suspend</th>
    	<th></th>
    	<th></th>
    	<th></th>
    	<th></th>
    </thead>
    <tbody>
    <!-- Loop to show all the users from the database -->
    @for ($x = 0; $x < count($users); $x++) 
        <tr>
        <td>{{$users[$x]['ID']}}</td>
        <td> {{$users[$x]['FIRSTNAME']}} </td>
        <td> {{$users[$x]['LASTNAME']}} </td>
        <td> {{$users[$x]['USERNAME']}} </td>
        <td> {{$users[$x]['ROLE']}} </td>
        <td> {{$users[$x]['SUSPEND']}} </td>
     
        <!-- include buttons for edit, suspend, and delete user -->
        <td><form action = '' method = 'POST'><input type = 'hidden' name = 'id' value = ".$users[$x]['ID']."><input type = 'submit' value = 'Edit'></form> </td> 
        <td><form action = 'suspendView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$users[$x]['ID']}}><input type = 'submit' value = 'Suspend'></form> </td>
        <td><form action = 'unsuspendView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$users[$x]['ID']}}><input type = 'submit' value = 'Unsuspend'></form> </td>
        <td><form action = 'deleteView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$users[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
        
        </tr>
   
    @endfor
    </tbody>
	</table>

	@else 
	<h4>Sorry, there are no users to show!</h4>
	@endif
	
@else 
<h4>Sorry, you must be an Admin to view this page!</h4>
@endif 

<script type="text/javascript">
$(document).ready( function () {
    $('#users').DataTable();
} );
</script>
            	

@endsection