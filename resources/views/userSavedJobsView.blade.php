<!-- 
//Almicke Navarro
//3-17-19
//Networking Milestone
//This is my own work.
//displays the jobs that the user has saved
 -->
   
<div class = savedJobs>
 	<!-- User's Saved Jobs -->
 	<div id = "user-groups"> 	
 		<h6 class = "heading column">Saved...</h6>
 		<br>
 		<p><br></p>
 		 @if ($savedjobs != null)
 		<table id = savedjobs class = "darkTable table-hover"> 
    	<tbody>
     		@for ($x = 0; $x < count($savedjobs); $x++) 
     		<tr>
     		<td>{{$savedjobs[$x]['NAME']}}</td>
     		<td>{{$savedjobs[$x]['COMPANY']}}</td>
     		<td>{{$savedjobs[$x]['PAY']}}</td>
     		<td>{{$savedjobs[$x]['DESCRIPTION']}}</td>
     		
     		<td><form action = 'unsaveJobView' method = 'POST'><input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>"><input type = 'hidden' name = 'id' value = {{$savedjobs[$x]['ID']}}><button type="submit" class="btn">Delete</button></form> </td>
     		
     		</tr>
     		@endfor 
 		</tbody>
 		</table>
 		@else 
        	<p>You have not saved any jobs!</p>
 		@endif 
 	</div>  
 </div>
