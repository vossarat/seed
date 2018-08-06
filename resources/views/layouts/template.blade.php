<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
	<head>
		<meta name="format-detection" content="telephone=no">
	    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta charset="utf-8">
	    <link rel="icon" href="images/favicon.png" type="image/x-icon">

		<title>
			@section('title')
			{{ $title or 'Zelenka.Trade' }}
			@show
		</title>
		
		<!--
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CQuattrocento+Sans:400,700">
		-->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
		
		
		
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
		
		<!-- Include Font-Awesome -->
		<link rel="stylesheet" href="{{ asset('css/fonts.css') }}">	
		
		<!-- additional CSS -->
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/project-style.css') }}" />
		
		<!-- MMENU Style -->
		<link rel="stylesheet" href="{{ asset('css/jquery.mmenu.css') }}" />		
		 
		 
		<!-- Include Some Style -->
		@stack('css')
		
	</head>

	<body>
	
		<!-- Page-->
    <div class="text-left page">
      <!-- Page preloader-->
      {{-- 
      <div class="page-loader">
        <div>
          <div class="page-loader-body">
            <div class="heartbeat"></div>
          </div>
        </div>
      </div>
      --}}
      
      <!-- Page Header-->
      <header class="page-header">
        
        <!-- RD Navbar-->
        @section('topbar')
		    @include('layouts.topbar')
		@show
		<!-- /RD Navbar-->
		
      </header>     
      	
      	@yield('content')
     
      	<!-- Contact us-->
      	@section('contact')
		    @include('layouts.contact')
		@show
      	
      
		<!-- Footer -->
	    @section('footer')
		    @include('layouts.footer')
		@show
		<!-- /Footer -->
    </div>
    
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    
    <!-- Bootstrap core JavaScript
	================================================== -->
	<script src="{{ asset('js/core.min.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>	
	
	<!-- MMENU JavaScript -->
	<script src="{{ asset('js/jquery.mmenu.js') }}"></script>
	
	
	@stack('scripts')
		
	</body>
</html>