<!-- Side Panel  -->
<div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                	<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  	Account
                	</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     @if (session()->has('userid'))
                    	<a class="dropdown-item" href="logout">Logout</a>
                    	
                     @else 
                    	<a class="dropdown-item" href="login">Login</a>
                    	<a class="dropdown-item" href="registration">Register</a>
                    	
               	     @endif
                    
                    </div>
                </li>
                
                <!-- Will Check to see if the user is logged in. If so the navbar will have a link to the user profile -->
                @if(session()->has('userid'))
                    <li class="nav-item active">
                    <a class="nav-link" href="viewProfile">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <!-- Will Check to see if the user that is logged in is a admin and will ad an admin tab if they are -->
                   @if(session()->has('role'))
                        
                       @if(session('role') == 1)
						
                        <li class="nav-item dropdown">
                			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  			Admin
                			</a>
                    		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    			<a class="dropdown-item" href="adminPageOfUsersView">User(s)</a>
                    			<a class="dropdown-item" href="adminPageOfJobsView">Job(s)</a>
                    			<a class="dropdown-item" href="adminPageOfGroupsView">Group(s)</a>
                    			
                    			<hr> 
                    			<a class="dropdown-item" href="addJobPostingsView">Add Job Posting</a>
                    			<a class="dropdown-item" href="addGroupsView">Add Group</a>
                    		</div>
                		</li>
                                              
               		   @endif 
               		@endif 
               	@endif
					<ul class = "footer">© 2019 Copyright: Networking.com</ul>
            </ul>
</div>

<button class="openbtn" onclick="openNav()">&#9776; Menu</button> 


<script>
/* Set the width of the sidebar to 250px (show it) */
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  
}

/* Set the width of the sidebar to 0 (hide it) */
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
  document.body.style.backgroundColor = "white";
  
}
</script>