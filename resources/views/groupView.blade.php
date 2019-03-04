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
    <h2 class = "heading1">{{$groupdata[0]['GROUP_NAME']}}</h2>
   	<h5>{{$groupdata[0]['DESCRIPTION']}}</h5>
   	<td><form action = 'joinGroupView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$groupdata[0]['GROUPS_ID']}}><input type = 'submit' value = 'Join'></form> </td>
   	
    <hr>
    
    <table id = groups class = "darkTable table-hover"> 
    <thead>	
        <th>Members</th>
    </thead>
    <tbody>

    <!-- Loop to show all the users from the database -->
    @for ($x = 0; $x < count($groupdata); $x++)        
    <tr>
    <td> {{$groupdata[$x]['USERNAME']}} </td>
	</tr>
   
   	@endfor
    </tbody>
	</table>
</div>
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