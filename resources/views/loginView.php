<!-- 
//Mariah Valenzuela and Almicke Navarro
//1-19-19
//Networking Milestone
//This is my own work.
//The Login form
 -->
<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Login</title>
	
	<style type="text/css">
	
        * {box-sizing: border-box}
        
        .container {
            margin: auto;
            width: 500px;
            padding: 16px;
        }
        
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }
        
        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }
        
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .loginbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
        
        a {
            color: dodgerblue;
        }
        
        .noaccount {
            background-color: #f1f1f1;
            padding: 16px 20px;
            text-align: center;
            width: 468px;
            margin: auto;      
        }
        	
	</style>
</head>
<body>
    <form action = "loginView" method = "POST">
    	<input type = "hidden" name = "_token" value = "<?php  echo csrf_token()?>">
        <div class="container">
            <h1>Login</h1>
            <hr>

            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username">
            
            
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass">    
            
            <button type="submit" class="loginbtn">Log In</button>
  			</div>      
            
            <!-- This will be implemented later when I figure out how to add a link-->
            <div class="noaccount">
            <label>Don't have an account? <a href="#">Register Now</a>.</label>
        </div>
    </form>
</body>	