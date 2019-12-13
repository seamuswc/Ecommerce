<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($settings['site_name'])) ?$settings['site_name'] : 'Eccomerce' }} - Register</title>
    <meta name="description">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="ht-100 bg--background-grey">
        <div class="ui grid container ht-100 middle aligned">
            <div class="sixteen wide mobile eight wide tablet seven wide computer column centered">
                <div class="ui card fluid">
                    <div class="content">
                        <div class="header">{{ (isset($settings['site_name'])) ?$settings['site_name'] : 'Eccomerce' }} {{ __('translations.buttons.register') }}</div>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ action('Auth\registerController@register') }}" class="ui form">
                            @csrf
                            <div class="field">
                                <label for="username">{{ __('translations.labels.username') }}</label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="{{ __('translations.labels.username') }}" required>
                                @if ($errors->has('username'))
                                    <div class="ui pointing red basic label">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>
                            <div class="field">
                                <label for="password">{{ __('translations.labels.password') }}</label>
                                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="{{ __('translations.labels.password') }}" required>
                                @if ($errors->has('password'))
                                    <span class="error-text"> {{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <button class="ui button button--primary fluid" type="submit">{{ __('translations.buttons.register') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
</body>
</html>
