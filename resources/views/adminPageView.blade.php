<!--
//Almicke Navarro
//2-9-19
//Networking Milestone
//This is my own work.
//The form that allows admin to do admin functions
-->

@extends('layouts.appmaster')
@section('title', 'Admin Page')
  
@section('content')

<div class = "form">
   
    <h3 class = "heading1">Admin</h3>
    <hr> 
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
    @php
    use App\Services\BusinessServices\UserBusinessService;
    $bs = new UserBusinessService();
    $users = $bs->showAll();
    @endphp
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
        <!-- <td><form action = '' method = 'POST'><input type = 'hidden' name = 'id' value = ".$users[$x]['ID']."><input type = 'submit' value = 'Edit'></form> </td> -->
        <td><form action = 'suspendView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$users[$x]['ID']}}><input type = 'submit' value = 'Suspend'></form> </td>
        <td><form action = 'unsuspendView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$users[$x]['ID']}}><input type = 'submit' value = 'Unsuspend'></form> </td>
        <td><form action = 'deleteView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$users[$x]['ID']}}><input type = 'submit' value = 'Delete'></form> </td>
        
        </tr>
   
    @endfor
    </tbody>
</table>
<script type="text/javascript">
$(document).ready( function () {
    $('#users').DataTable();
} );
</script>
            	
</div>

@endsection