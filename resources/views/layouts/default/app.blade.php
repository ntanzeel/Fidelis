<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') . (!empty($title) ? ' :: ' . $title : '') }}</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        @push('fonts')
        <link href="{{ asset('assets/css/fonts/Raleway.css') }}" rel="stylesheet" type="text/css">
        @endpush
        @stack('fonts')

    <!-- Framework Stylesheets -->
        @push('frameworks.stylesheets')
        <link href="{{ asset('assets/css/frameworks/bootstrap/3.3.7.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/frameworks/bootstrap/override.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/frameworks/bootstrap/bootstrap-switch.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/frameworks/font-awesome/css/4.7.0.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/frameworks/highlight.js/9.9.0.min.css') }}" rel="stylesheet">
    @endpush
    @stack('frameworks.stylesheets')

    <!-- App Stylesheets -->
        <link href="{{ asset('assets/css/layouts/default/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/layouts/default/_shared.css') }}" rel="stylesheet">

        <!-- Components -->
        <link href="{{ asset('assets/css/layouts/default/components/ui/lightbox.css') }}" rel="stylesheet">

        <!-- Forced Stylesheets -->
    @stack('stylesheets')

    <!-- Local Stylesheets -->
    @foreach($stylesheets as $key => $stylesheet)
        <!--{{ $key }}-->
            <link href="{{ asset($stylesheet) }}" rel="stylesheet">
    @endforeach

    <!-- Scripts -->
        <script type="text/javascript">
            {!! 'window.Laravel = ' . json_encode(['csrfToken' => csrf_token()])  !!}
        </script>
    </head>
    <body>
        <div id="app">
            @section('header')
                @include('layouts.default.partials.header', compact('navigation', 'categories'))
            @show
            <div class="page-container">
                @section('container')
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                @show
            </div>

            @section('footer')
                @include('layouts.default.partials.footer')
                @include('components.ui.lightbox')
            @show
        </div>

        <!-- Framework Scripts -->
        @push('frameworks.scripts')
        <script src="{{ asset('assets/js/frameworks/jquery/3.1.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/frameworks/bootstrap/3.3.7.min.js') }}"></script>
        <script src="{{ asset('assets/js/frameworks/highlight.js/9.9.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/frameworks/bootstrap/bootstrap-switch.min.js') }}"></script>
        @endpush
        @stack('frameworks.scripts')

    <!-- App Scripts -->
        <script src="{{ asset('assets/js/layouts/default/_shared.js') }}"></script>
        <script src="{{ asset('assets/js/layouts/default/app.js') }}"></script>

        <!-- Components -->
        <script src="{{ asset('assets/js/layouts/default/components/ui/lightbox.js') }}"
                type="text/javascript"></script>

        <!-- Forced Scripts -->
        @stack('scripts')

    <!-- Local Scripts -->
        @foreach($scripts as $key => $script)
        <!--{{ $key }}-->
            <script src="{{ asset($script) }}"></script>
        @endforeach
    </body>
</html>