<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>
   
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="site-wrapper admin">
        <header>
            <div class="ui menu">
                <div class="header item">
                    <a href="{{ URL::to('/') }}">ECCOMERCE</a>
                </div>
                <div class="right menu">
                    <a class="item"><strong>{{ auth()->user()->username }}</strong></a>
                    <a href="{{ action('Auth\loginController@logout') }}" class="item">{{ __('translations.texts.logout') }}</a>
                </div>
            </div>
        </header>
        <main class="main-content p-2">
            <div class="ui grid">
                <div class="sixteen wide mobile five wide tablet three wide computer column">
                    <div class="ui vertical menu fluid">
                        <div class="item">
                            <strong>{{ __('translations.headings.menu') }}</strong>
                        </div>
                        <a href="{{ action('AdminController@manage') }}" class="{{ Request::segment(1)=='manage' ? 'active teal':'' }} item">
                            <span> <i class="cart icon"></i> {{ __('translations.headings.manage') }}</span>
                        </a>
                        <a href="{{ action('AdminController@pending') }}" class="{{ Request::segment(1)=='pending' ? 'active teal':'' }} item">
                            <span> <i class="truck icon"></i> {{ __('translations.headings.pending_shipment') }}</span>
                        </a>
                        <a href="{{ action('AdminController@shipped') }}" class="{{ Request::segment(1)=='shipped' ? 'active teal':'' }} item">
                            <span> <i class="paper plane icon"></i>{{ __('translations.headings.sent_shipment') }}</span>
                        </a>
                        <a href="{{ action('SettingsController@index') }}" class="{{ Request::segment(1)=='settings' ? 'active':'' }} item">
                            <span> <i class="cogs icon"></i>{{ __('translations.headings.settings') }}</span>
                        </a>
                    </div>
                </div>
                <div class="sixteen wide mobile eleven wide tablet thirteen wide computer column">
                    @if ($notification = session('notification'))
                        {{ show_notification($notification['message'], $notification['type']) }}
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>
        <input type="hidden" ref="baseUrl" value="{{ url('/') }}">
        <input type="hidden" ref="cryptoRate" value="{{ (isset(session('cryptoRate')['cryptoRate'])) ? session('cryptoRate')['cryptoRate'] : App\cryptocurrency::getRate() }}">
    </div>
    <script src="{{ asset('js/jquery.3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    @yield('page-script-before')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('page-script-after')
</body>
</html>
