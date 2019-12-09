<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kowloon Shirts</title>

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    <!-- SEO -->
    <meta name="description" content="Description">
    <meta name="Keywords" content="keywords here">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="url">
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">

    @yield('page-style')
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .logo {
            max-width: 400px !important;
            width: 100%;
        }

        .countdown {
            font-size: 32px;
        }
    </style>
</head>
<body>
    <div id="app" class="site-wrapper ht-100">
        <div class="main-content">
            <div class="ui container grid content-wrapper">
                <div class="row">
                    <div class="sixteen wide column text-center middle aligned">
                        <img src="{{ asset('images/logo.svg') }}" class="logo">
                        <div class="countdown color--grey-5 mt-2"></div>
                    </div>
                </div >
            </div>
        </div>
    </div>
       
    <script src="{{ asset('js/jquery.3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.countdown').countdown('2019/09/10', function(event) {
                $(this).html(event.strftime('%D days %H:%M:%S'));
            });
        });
    </script>
   
</body>
</html>
