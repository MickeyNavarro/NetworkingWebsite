<!-- Navbar -->
<div align = "center">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Networking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                	<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  	Account
                	</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    	<a class="dropdown-item" href="login">Login</a>
                    	<a class="dropdown-item" href="registration">Register</a>
                    </div>
                </li>
                
                <!-- Will Check to see if the user is logged in. If so the navbar will have a link to the user profile -->
                @php
                if(session()->has('userid')){
                @endphp
                    <li class="nav-item active">
                    <a class="nav-link" href="viewProfile">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <!-- Will Check to see if the user that is logged in is a admin and will ad an admin tab if they are -->
                   @php 
                   if(session()->has('role')){
                        
                       if(session('role') == 1){
                        @endphp
						
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
                                              
                        @php 
                        }
                    }
                }
                @endphp                
                
            </ul>
        </div>
    </nav>
</div>
