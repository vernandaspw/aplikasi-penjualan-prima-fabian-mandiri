<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title')
        PFM STORE</title>

    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="{{ asset('summernote/summernote.min.css') }}"> --}}

    <style>
        body {
            font-family: 'roboto', sans-serif;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        div.scrollmenu {
            overflow: auto;
            white-space: nowrap;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        div.scrollmenu::-webkit-scrollbar {
            display: none;
        }


        div.scrollmenu a {
            display: inline-block;
            text-align: center;
            /* padding-top: 8px;
        padding-bottom: 8px; */
            color: black;
            text-decoration: none;
        }

        div.scrollmenu .card:hover {
            color: white;
            border: none;
            background-color: {{ env('COLOR_PRIMARY') }};
        }
    </style>

    @stack('style')

    @livewireStyles
</head>

<body class="antialiased" id="body">

    @yield('content')
    {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}


    @livewireScripts

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    @stack('script')


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

</body>

</html>
