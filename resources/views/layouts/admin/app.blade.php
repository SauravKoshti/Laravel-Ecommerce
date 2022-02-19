<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@hasSection('template_title')@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="Jeremy Kenedy">
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

        @yield('template_linked_fonts')
        {{-- Styles --}}
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        @yield('template_linked_css')

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        @include('scripts.ga-analytics')
        @if(Auth::check())
            @include('partials.admin.head')
        @else
            @include('partials.admin.login-head')
        @endif
    </head>
    <!-- Different layout for login page and other pages  -->
    @if(Auth::check())
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
              <img class="animation__shake" src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div>
            @include('partials.admin.nav')
            <!-- sidebar -->
            @include('partials.admin.sidebar')
            <main>
                <div class="content-wrapper px-2 py-5">
                    @include('partials.form-status')
                    @yield('content')
                </div>
            </main>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar --> 
            @include('partials.admin.footer')
        </div>
    @else
    <body>
        <div id="app">
            @include('partials.nav')
            <main class="py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            @include('partials.form-status')
                        </div>
                    </div>
                </div>
                @yield('content')
            </main>
        </div>
    @endif
        @include('partials.admin.script')
        <script src="{{ asset('/js/app.js') }}"></script>
        @yield('footer_scripts')
        {{-- Scripts --}}
    </body>
</html>