<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>
            @section('title')
            {{ $title or 'Zelenka.Trade' }}
            @show
        </title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('css/dashboard/bootstrap.min.css') }}">

        <!-- Include Font-Awesome -->
        <link rel="stylesheet" href="{{ asset('css/dashboard/font-awesome.min.css') }}">

        <!-- additional CSS -->
        <link rel="stylesheet" href="{{ asset('css/dashboard/template.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/dashboard/sidebar.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/dashboard/topbar.css') }}" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">


        <!-- Include Some Style -->
        @stack('css')

    </head>

    <body>

        @section('topbar')
        	@include('dashboard.topbar')
        @show

        <div class="container-fluid">

            <div class="row">

                {{--
                <div class="col-md-1 sidebar">
                    @section('sidebar')
                    @include('dashboard.sidebar')
                    @show
                </div>
                --}}

                <div class="col-xs-12 content-dashboard">
                    @yield('content')
                </div>
            </div>


        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script src="{{ asset('js/dashboard/jquery.min.js') }}"></script>
        <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
		</script>


        <script src="{{ asset('js/project.scripts.js') }}"></script>
        @stack('scripts')


    </body>
</html>