<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eccomerce</title>
    
    <!-- SEO -->
    <meta name="description" content="Description">
    <meta name="Keywords" content="Keywords">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="url">
    
    @yield('page-style')
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
      .ignore-css{all:unset;}
    </style>
</head>
<body>
    <div id="app" class="site-wrapper ht-100">
        <div class="main-content">
            <header class="site-header ui container grid">
                <div class="row">
                    <div class="eight wide column">
                        <a href="{{ URL::to('/') }}">
                           <img src="{{ asset('images/logo.svg') }}" class="logo">
                        </a>
                    </div>
                    <div class="middle aligned eight wide column text-right">
                        @if(Route::getCurrentRoute()->uri() == '/')
                            <span id="show-cart-button" class="cart-link"><i class="large shopping cart icon"></i><span class="cart-link__count" v-if="qty.length" v-cloak>@{{ qty }}</span></span>
                        @endif
                    </div>
                </div>
            </header>
            <div>
                @yield('content')
            </div>
        </div>
        <input type="hidden" ref="baseUrl" value="{{ url('/') }}">
        <input type="hidden" ref="cryptoRate" value="{{ (isset(session('cryptoRate')['cryptoRate'])) ? session('cryptoRate')['cryptoRate'] : App\cryptocurrency::getRate() }}">
        @include('layouts.modals.checkPaymentModal')
    </div>
       
    <script src="{{ asset('js/jquery.3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    @yield('page-script-before')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('page-script-after')
   
</body>
</html>
