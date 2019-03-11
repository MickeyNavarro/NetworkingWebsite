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
    <h2 class = "heading1">{{$groupdata->getGroup_name()}}</h2>
   	<h5>Description: {{$groupdata->getDescription()}}</h5>
   	<td><form action = 'joinGroupView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$groupdata->getId()}}><input type = 'submit' value = 'Join'></form> </td>
   	
    <hr>
    
    <h5>Members</h5>
    <table id = groups class = "darkTable table-hover"> 
    <thead>	
    </thead>
    <tbody>

	@if ($groupusers != null)

    <!-- Loop to show all the users from the database -->
    @for ($x = 0; $x < count($groupusers); $x++)        
    <tr>
    <td> {{$groupusers[$x]['USERNAME']}} </td>
	</tr>
   
   	@endfor
   	@else 
   	<p>There are no members in this group!</p>
   	@endif
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