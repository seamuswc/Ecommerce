@extends('layouts.admin')

@section('page-title', 'Settings')

@section('content')
    <div class="ui card fluid">
        <div class="content">
            <div class="header">
                <h2 class="ui header">{{ __('translations.headings.settings') }}</h2>
            </div>
        </div>
        <div class="content">
            <form  method="POST" action="{{ action('SettingsController@updateBasicInfo') }}" class="ui form basic-info-form">
                @csrf
                <h3 class="mt-1">{{ __('translations.headings.basic_info') }}</h3>
                <div class="field {{ ($errors->first('site_name')) ? 'error' : '' }}">
                    <label for="siteName">{{ __('translations.labels.site_name') }}</label>
                    <input id="siteName" type="text" class="input" name="site_name" value="{{ old('site_name',(isset($all_settings['basic_info']['value']['site_name'])) ? $all_settings['basic_info']['value']['site_name'] : '') }}">
                </div>
                <h3>{{ __('translations.headings.gemini') }}</h3>
                <div class="two fields">
                    <div class="field {{ ($errors->first('gemini_key')) ? 'error' : '' }}">
                        <label for="geminiKey">{{ __('translations.labels.key') }}</label>
                        <input id="geminiKey" type="text" class="input" name="gemini_key" value="{{ old('gemini_key',(isset($all_settings['basic_info']['value']['key'])) ? 'CURRENTLY SET' : '') }}">
                    </div>
                    <div class="field {{ ($errors->first('gemini_secret')) ? 'error' : '' }}">
                        <label for="geminiSecret">{{ __('translations.labels.secret') }}</label>
                        <input id="geminiSecret" type="text" class="input" name="gemini_secret" value="{{ old('gemini_secret',(isset($all_settings['basic_info']['value']['secret'])) ? 'CURRENTLY SET' : '') }}">
                    </div>
                </div>
                <div class="field group">
                    <button class="ui red button right floated" type="submit">{{ __('translations.buttons.save') }}</button>
                </div>
            </form>
            <div class="ui divider"></div>
            <form  method="POST" action="{{ action('CountryController@store') }}" class="ui form country-form">
                @csrf
                <h3>{{ __('translations.headings.country_and_code') }}</h3>
                <div class="three fields">
                    <div class="field {{ ($errors->first('country')) ? 'error' : '' }}">
                        <label for="country">{{ __('translations.labels.country') }}</label>
                        <div id="countryDropdown" class="ui fluid selection dropdown">
                            <input id="country" type="hidden" name="country" value="{{ old('country') }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">{{ __('translations.labels.country') }}</div>
                            <div class="menu">
                                @if($countries !== null)
                                    @foreach($countries as $key => $value)
                                        <div class="item" data-value="{{ $key }}|{{ $value }}">{{ $value }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="field {{ ($errors->first('callingCode')) ? 'error' : '' }}">
                        <label for="callingCode">{{ __('translations.labels.calling_code') }}</label>
                        <div class="ui left icon input" data-children-count="1">
                            <i class="plus icon"></i>
                            <input type="text" id="callingCode" class="input" name="calling_code" value="{{ old('calling_code') }}"  @keypress="isNumber($event)" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                        </div>
                    </div>
                    <div class="field {{ ($errors->first('shipping')) ? 'error' : '' }}">
                        <label for="tariff">{{ __('translations.labels.shipping') }}</label>
                        <div class="ui left icon input" data-children-count="1">
                            <i class="dollar icon"></i>
                            <input type="text" id="shipping" class="input" name="shipping" value="{{ old('shipping') }}"  @keypress="isNumber($event)" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                        </div>
                    </div>

                </div>
                <div class="field group">
                    <button class="ui red button right floated" type="submit">{{ __('translations.buttons.save') }}</button>
                </div>
            </form>
            @if($supportedCountries->count())
                <table class="ui celled table mt-2 mb-2">
                    <thead>
                        <th>{{ __('translations.labels.country') }}</th>
                        <th>{{ __('translations.labels.code') }}</th>
                        <th>{{ __('translations.labels.shipping') }}</th>
                        <th class="right aligned">{{ __('translations.labels.options') }}</th>
                    </thead>
                    <tbody>
                        @foreach($supportedCountries as $supportedCountry)
                            <tr>
                                <td>{{ $supportedCountry->name }}</td>
                                <td>{{ $supportedCountry->calling_code }}</td>
                                <td>${{ $supportedCountry->shipping }}</td>
                                <td class="group">
                                    <form method="POST" action="{{ action('CountryController@delete',['id'=>$supportedCountry->id]) }}" class="ui right floated" onSubmit="return confirm('{{ __('translations.texts.delete_confirm') }} {{ $supportedCountry->name }}?');">
                                        @method('delete')
                                        @csrf
                                        <button class="mini ui red button">{{ __('translations.buttons.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
@section('page-script-after')
    <script>
        $(document).ready(function(){

            $('.ui.basic-info-form').form({
                fields: {
                    site_name: 'empty',
                    gemini_key : 'empty',
                    gemini_secret: 'empty',
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
        });
    </script>
@endsection
