<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    @section('css') 
        
    @show

    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>

    <title>Fnac</title>

    <!-- Styles -->
    

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>


<body class="antialiased">
    

    @section('header') 
        @include('layout.header-home')
    @show



    @yield('content')

    {{-- <script src="{{ asset("js/app.js") }}"></script> --}}


    @section('js') 
        
    @show

    </body>
</html>
