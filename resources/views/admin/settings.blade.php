@extends('layouts.admin')

@section('content')
    <div class="ui card fluid">
        <div class="content">
            <div class="header">
                <h2 class="ui header">{{ __('translations.headings.settings') }}</h2>
            </div>
        </div>
        <div class="content">
            <div class="ui top attached tabular menu">
                <a class="item {{ (session('settingsTab') === 'apiKeys' || session('settingsTab') === null) ? 'active': '' }}" data-tab="first">{{ __('translations.headings.api_keys') }}</a>
                <a class="item {{ (session('settingsTab') === 'country') ? 'active': '' }}" data-tab="second">{{ __('translations.headings.country_and_code') }}</a>
                <a class="item {{ (session('settingsTab') === 'carrier') ? 'active': '' }}" data-tab="third">{{ __('translations.headings.carrier') }}</a>
            </div>
            @include('partials.settingsApiKeys')
            @include('partials.settingsCountryAndCode')
            @include('partials.settingsCarrier')
        </div>
    </div>
@endsection
@section('page-script-after')
    <script>
        $(document).ready(function(){

            $('.ui.nexmo-form').form({
                fields: {
                    nexmoKey : 'empty',
                    nexmoSecret: 'empty',
                    smsFrom: 'empty'
                }
            });

            $('.ui.gemini-form').form({
                fields: {
                    geminiKey : 'empty',
                    geminiSecret: 'empty',
                }
            });

            $('.ui.country-form').form({
                fields: {
                    country : 'empty',
                    callingCode: 'empty',
                    import_tariff: 'empty',
                    sales_tax: 'empty',
                    shipping: 'empty'

                }
            });

            $('.ui.carrier-form').form({
                fields: {
                    carrier : 'empty',
                }
            });
        });
    </script>
@endsection
