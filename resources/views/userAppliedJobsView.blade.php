<!-- 
//Almicke Navarro
//3-17-19
//Networking Milestone
//This is my own work.
//displays the jobs that the user has applied to
 -->
   
<div class = appliedJobs>
 	<!-- User's Jobs Applied To-->
 	<div id = "user-groups"> 	
 		<h6 class = "heading column">Applied for...</h6>
 		<br>
 		<p><br></p>
 		 @if ($appliedjobs != null)
 		<table id = appliedjobs class = "darkTable table-hover"> 
    	<tbody>
     		@for ($x = 0; $x < count($appliedjobs); $x++) 
     		<tr>
     		<td>{{$appliedjobs[$x]['NAME]}}</td>
     		<td>{{$appliedjobs[$x]['COMPANY']}}</td>
     		<td>{{$appliedjobs[$x]['PAY']}}</td>
     		<td>{{$appliedjobs[$x]['DESCRIPTION']}}</td>
     		     		
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@else 
        	<p>You have not applied to any jobs!</p>
 		@endif 
 	</div>  
 </div>
