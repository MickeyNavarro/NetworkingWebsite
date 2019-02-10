<!DOCTYPE html>
<html lang = "en">
    <head>
    	<title>@yield('title')</title>
    	
    	<!-- Font -->
    	<link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC" rel="stylesheet">
        <!-- Navbar -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    
        <!-- My Stylesheet -->
        <link rel="stylesheet" type="text/css" href="/NetworkingMilestone/public/css/styles.css" /> 
            
    </head> 
    <body>
    	
    	@include('layouts.header')
    	  
        <div class = "content">
        	@yield('content')	
        </div>
        
        <div class="push"></div>
    	
    	@include('layouts.footer')
    </body>
</html>