<?php
use App\Services\BusinessServices\UserBusinessService;
?>
<!--
//Almicke Navarro
//2-9-19
//Networking Milestone
//This is my own work.
//The form that allows admin to do admin functions
-->

@extends('layouts.appmaster')
@section('title', 'Login Page')
  
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
    <?php
    $bs = new UserBusinessService(); 
    $users = $bs->showAll(); 
    for ($x = 0; $x < count($users); $x++) {
        echo "<tr>";
        echo "<td>" . $users[$x]['ID'] . "</td>";
        echo "<td>" . $users[$x]['FIRSTNAME'] . "</td>";
        echo "<td>" . $users[$x]['LASTNAME'] . "</td>";
        echo "<td>" . $users[$x]['USERNAME'] . "</td>";
        echo "<td>" . $users[$x]['ROLE'] . "</td>";
        echo "<td>" . $users[$x]['SUSPEND'] . "</td>";
        
        
        //include buttons for edit, suspend, and delete user
        //echo "<td><form action = '' method = 'POST'><input type = 'hidden' name = 'id' value = ".$users[$x]['ID']."><input type = 'submit' value = 'Edit'></form> </td>";
        echo "<td><form action = 'suspendView' method = 'GET'><input type = 'hidden' name = 'id' value = ".$users[$x]['ID']."><input type = 'submit' value = 'Suspend'></form> </td>";
        echo "<td><form action = 'unsuspendView' method = 'GET'><input type = 'hidden' name = 'id' value = ".$users[$x]['ID']."><input type = 'submit' value = 'Unsuspend'></form> </td>";
        echo "<td><form action = 'deleteView' method = 'GET'><input type = 'hidden' name = 'id' value = ".$users[$x]['ID']."><input type = 'submit' value = 'Delete'></form> </td>";
        
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<script type="text/javascript">
$(document).ready( function () {
    $('#users').DataTable();
} );
</script>
            	
</div>

@endsection