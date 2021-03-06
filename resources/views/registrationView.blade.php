<!-- 
//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The registration form
 -->
<!DOCTYPE html>
<html lang = "en">
    <head>
    	<title>Registration Page</title>
    	
    	<!-- Font -->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <!-- Side Panel -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    
        <!-- My Stylesheet -->
        <link rel="stylesheet" type="text/css" href="/public/css/styles.css" /> 
            
</head> 
  
<body>
<div class ="everything">
    @include('layouts.sidepanel')

    <div class = "top">   
    	<nav class="navbar">
        	<div>
			<button class="openbtn" style = "font-family: 'Fjalla One', sans-serif;" onclick="openNav()">&#9776;</button> 
			
            </div>
            <div>
            	<h1>Registration</h1>
            </div>		
    	</nav>
    </div>
    
    <div class = "main">
    <div class = form>
    <form action = "registrationView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
            <h2>Create an Account</h2>
            <hr>
            
            <label>First Name</label>
            <input type="text" placeholder="Enter First Name" name="firstname">
            
            <label>Last Name</label>
            <input type="text" placeholder="Enter Last Name" name="lastname">
            
            
            <label>Username</label>
            <input type="text" placeholder="Enter Username" name="username">
            
            <label>Email</label>
            <input type="text" placeholder="Enter Email" name="email">
            
            
            <label>Password</label>
            <input type="password" placeholder="Enter Password" name="password">    
            
            <button type="submit" class="registerbtn">Register</button>    
            
            <div class="signin">
            <label >Already have an account? <a href="login">Sign in</a>.</label>
        </div>
    </form>
</div>
<!-- Output list of errors, if any-->
	@if($errors->count() != 0)
		@foreach($errors->all() as $message)
			{{$message}} <br/> 
		@endforeach 
	@endif
</div>	
</div>	
</body>
</html>
