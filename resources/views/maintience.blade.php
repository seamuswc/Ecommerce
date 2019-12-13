<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (isset($settings['site_name'])) ?$settings['site_name'] : 'ECCOMERCE' }}</title>

    <!-- SEO -->
    <meta name="description" content="Description">
    <meta name="Keywords" content="keywords here">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="url">
    
    @yield('page-style')
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .logo {
            font-size: 70px;
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
                        <h1 class="logo">{{ (isset($settings['site_name'])) ?$settings['site_name'] : 'ECCOMERCE' }}</h1>
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
