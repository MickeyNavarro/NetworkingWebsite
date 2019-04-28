<!DOCTYPE html>
<html lang = "en">
    <head>
    	<title>@yield('title')</title>
    	
    	<!-- Font -->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <!-- Side Panel -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    
        <!-- My Stylesheet -->
        <link rel="stylesheet" type="text/css" href="/public/css/styles.css" />  
        <!-- Data Tables -->
        <script type="text/javascript" src="{{ URL::asset('//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css') }}" />
            
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
            	<h1>@yield('title')</h1>
            </div>		
    	</nav>
    </div>
    
    <div class = "main">
    @if (session()->has('userid'))
        	  
        <div class = "content">
        	@yield('content')	
        </div>
  
        <div class="push"></div>
    	@else 
		<h4>Sorry, you must login to view this page!</h4>
		@endif
	</div>
</body>
</html>
