<!--
//Almicke Navarro
//3-3-19
//Networking Milestone
//This is my own work.
//The form that allows users to view, leave, and join all groups
-->

@extends('layouts.appmaster')
@section('title', 'Group(s) Page')
  
@section('content')

@if(session()->has('role'))
    <h3 class = "heading1">Join New Groups</h3>
    <hr> 
    @if ($groups != null)
    <table id = groups class = "darkTable table-hover"> 
    <thead>	
        <th>Name </th>
        <th>Description</th>
    	<th></th>
    	<th></th>
    </thead>
    <tbody>

    <!-- Loop to show all the groups from the database -->
    @for ($x = 0; $x < count($groups); $x++) 
        <tr>
        <td> {{$groups[$x]['GROUP_NAME']}} </td>
        <td> {{$groups[$x]['DESCRIPTION']}} </td>
        <td><form action = 'joinGroupView' method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$groups[$x]['ID']}}><button type="submit" class="btn">Join</button></form> </td>
        <td><form action = 'groupView' method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$groups[$x]['ID']}}><button type="submit" class="btn">View Members</button></form> </td>
        
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
    $('#groups').DataTable();
} );
</script>
            	

@endsection