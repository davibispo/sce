<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <!--Fonts Icons-->
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/font-awesome.min.css')}}">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <script src="js/jquery-3.2.1.min.js"></script>  
        <script src="js/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.min.js"></script>  
        
        <title>SCE</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('layouts.header')
        <object classid="CLSID:F66B9251-67CA-4d78-90A3-28C2BFAE89BF" height=0 width=0 id="objNBioBSP" name="objNBioBSP"></object>
        <div id="app">
            <div class="container">
                @yield('content')
            </div>

        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        
        <!--jQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        @stack('scripts')
    </body>
</html>
