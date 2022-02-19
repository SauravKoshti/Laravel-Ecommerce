<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Site Metas -->
        <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Site Icons -->
        @include('partials.head')
    </head>
    <body>
        @include('partials.topnav')
        @include('partials.navbar')        
        @yield('content')
        @include('partials.footer')
        <!-- ALL JS FILES -->
        @include('partials.script')
        @yield('footer_scripts')
    </body>
</html>