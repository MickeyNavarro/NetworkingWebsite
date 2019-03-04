<!-- 
//Almicke Navarro
//3-2-19
//Networking Milestone
//This is my own work.
//displays the groups that the user is apart of 
 -->
   
<div class = groups>
 	<!-- User Groups -->
 	<div id = "user-groups"> 	
 		<h5 class = "heading column">Group(s)</h4>
 		<br>
 		<p><br></p>
 		 @if ($usergroups != null)
 		<table id = user-groups class = "darkTable table-hover"> 
    	<tbody>
     		@for ($x = 0; $x < count($usergroups); $x++) 
     		<tr>
     		<td>{{$usergroups[$x]['GROUP_NAME']}}</td>
     		<td><form action = 'leaveGroupView' method = 'GET'><input type = 'hidden' name = 'id' value = {{$usergroups[$x]['ID']}}><input type = 'submit' value = 'Leave'></form> </td>
     		
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@else 
        	<p>You are currently not in any groups!</p>
 		@endif 
 	</div>  
 </div>
