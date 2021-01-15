<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <!--<meta name="csrf-token" content="{{ csrf_token() }}">-->

        <title>@yield('title') - {{ config('app.name', 'Laravel') }} </title>

        <!-- Styles -->
        <link href="{{ asset('css/bulma-switch.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bulma.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('js/selectr/selectr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/auto-complete/auto-complete.css') }}" rel="stylesheet">

        @yield('extra-css')
        <!-- Fontawesome icons -->
        <script src="{{ asset('js/fontawesome/js/fontawesome-all.js') }}"></script>
        <script src="{{ asset('js/selectr/selectr.min.js') }}"></script>
        <script src="{{ asset('js/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('js/flatpickr/es.js') }}"></script>
        <script src="{{ asset('js/axios/axios.min.js') }}"></script>
        <script src="{{ asset('js/auto-complete/auto-complete.min.js') }}"></script>

    </head>
        <body>
        @include('_partials.navbar')
        @yield('content')
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('extra-js')
    </body>
</html>