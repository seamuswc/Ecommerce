@extends('layouts.storefront')

@section('page-title', 'Home')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
@endsection

@section('content')
    @if ($notification = session('notification'))
        <div class="ui container grid">
            <div class="column wide">
                {{ show_notification($notification['message'],$notification['type']) }}
            </div>
        </div>
    @endif
    <div class="ui container grid content-wrapper product">
        @if($product != null)
            @php ( $rate = number_format( ($product->price) / session('crypto_rate')['crypto_rate'], 6) )
            @php ( $currency =  'USD' )
            <div class="row">
                <div class="sixteen wide mobile eight wide tablet eight wide computer column">
                    <div class="product__images">
                        <div class="product__image mb-1">
                            <img src="{{ asset('storage/'.$product->photo) }}" alt="Product Photo">
                        </div>
                    </div>
                </div>
                <div class="sixteen wide mobile eight wide tablet eight wide computer column">
                    <div class="product__info">
                        <h2 class="product__name text-uppercase">{{ $product->name }}</h2>
                        <div class="product__price">{{ $currency }} {{ $product->price }} <span class="color--grey-5">({{ App\cryptocurrency::$ticker_symbol }} {{ $rate }})</span></div>
                        <div class="product__qty mt-2">
                            <label for="qty">{{ __('translations.headings.qty') }}</label>
                            <div class="ui mini input">
                                <input type="number" id="qty" class="input" min="1" v-model="qty">
                            </div>
                        </div>
                        <div class="product__extra mt-h">
                            <!-- <div class="ui pointing secondary menu">
                                <a class="item active" data-tab="description">{{ __('translations.labels.description') }}</a>
                            </div> -->
                            <div class="ui bottom attached tab segment active color--grey-5 text-center--mobile" data-tab="description">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corrupti itaque asperiores, unde fugit aliquam aut quae voluptatibus modi rerum?</p>
                            </div>
                        </div>
                        <div class="ui items">
                            <div class="item">
                                <div class="content">
                                    <form class="ui form"  method="POST" action="{{ action('ShippingFormController@validateShippingForm') }}">
                                        @csrf
                                        <h3 class="ui header text-uppercase mt-0">{{ __('translations.headings.shipping_details') }}</h3>
                                        <div class="field {{ ($errors->first('name')) ? 'error' : '' }}">
                                            <label for="name">{{ __('translations.labels.name') }}</label>
                                            <input type="text" id="name" name="name" value="{{old('name')}}">
                                        </div>
                                        <div class="field">
                                            <div class="two fields">
                                                <div class="eight wide field {{ ($errors->first('country')) ? 'error' : '' }}">
                                                    <label for="country">{{ __('translations.labels.country') }}</label>
                                                    <div id="countryDropdown" class="ui fluid selection dropdown">
                                                        <input id="country" type="hidden" name="country" value="{{ old('country','0|Country') }}">
                                                        <i class="dropdown icon"></i>
                                                        <div class="default text">{{ __('translations.labels.country') }}</div>
                                                        <div class="menu">
                                                            @if($supported_countries->count())
                                                                @foreach($supported_countries as $supported_country)
                                                                    <div class="item" data-value="{{ $supported_country->shipping }}|{{ $supported_country->name }}">{{ $supported_country->name }}</div>
                                                                @endforeach
                                                            @else
                                                                <div class="item" data-value="0|United States">United States</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="eight wide field {{ ($errors->first('state')) ? 'error' : '' }}">
                                                    <label for="state">{{ __('translations.labels.state') }}</label>
                                                    <input type="text" id="state" class="input" name="state" value="{{ old('state') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="two fields">
                                                <div class="eight wide field {{ ($errors->first('city')) ? 'error' : '' }}">
                                                    <label for="city">{{ __('translations.labels.city') }}</label>
                                                    <input type="text" id="city" class="input" name="city" value="{{ old('city') }}">
                                                </div>
                                                <div class="eight wide field {{ ($errors->first('postal')) ? 'error' : '' }}">
                                                    <label for="postal">{{ __('translations.labels.postal') }}</label>
                                                    <input type="text" id="postal" class="input" name="postal" value="{{ old('postal','') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field {{ ($errors->first('address1')) ? 'error' : '' }}">
                                            <label for="address1">{{ __('translations.labels.address_1') }}</label>
                                            <input type="text" id="address1" class="input" name="address1" value="{{ old('address1') }}">
                                        </div>
                                        <div class="field">
                                            <label for="address2">{{ __('translations.labels.address_2') }}</label>
                                            <input type="text" id="address2" class="input" name="address2" value="{{ old('address2') }}">
                                        </div>
                                        <div class="field {{ ($errors->first('phone')) ? 'error' : '' }}">
                                            <label for="phone">{{ __('translations.labels.phone') }} <small>({{__('translations.labels.phone_tracking')}})</small></label>
                                            <div class="two fields">
                                                <div class="five wide field {{ ($errors->first('callingCode')) ? 'error' : '' }}">
                                                    <div id="callingCodeDropdown" class="ui fluid selection dropdown">
                                                        <input id="callingCode" type="hidden" name="callingCode" value="{{ old('callingCode', '') }}">
                                                        <i class="dropdown icon"></i>
                                                        <div class="default text">{{ __('translations.labels.code') }}</div>
                                                        <div class="menu">
                                                            @if($supported_countries->count())
                                                                @foreach($supported_countries as $supported_country)
                                                                    <div class="item" data-value="{{ $supported_country->calling_code }}|{{ $supported_country->name }}"><i class="{{ $supported_country->iso }} flag"></i>{{ $supported_country->calling_code }}</div>
                                                                @endforeach
                                                            @else
                                                                <div class="item" data-value="+1|United States"><i class="us flag"></i>+1</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="eleven wide field {{ ($errors->first('phone')) ? 'error' : '' }}">
                                                    <input type="text"  class="input" name="phone" value="{{ old('phone') }}" @keypress="isNumber($event)" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <button class="ui button button--primary fluid" type="submit" :class="{disabled: qty === ''}">{{ __('translations.buttons.place_order') }}</button>
                                        </div>
                                        <input type="hidden" v-model="qty" name="qty">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('page-script-after')
    <script>
        $(document).ready(function(){

            $('.ui.form').form({
                fields: {
                    name        : 'empty',
                    country     : 'not[0|country]',
                    state       : 'empty',
                    city        : 'empty',
                    address1    : 'empty',
                    postal      : 'empty',
                    phone       : 'number'
                }
            });

            $('#countryDropdown').dropdown({
                onChange: function() {

                    var country = ($('#country').val()).split('|');

                    //set calling code
                    $('#callingCodeDropdown').dropdown('set selected',get_calling_code(country[1]));
                    //trigger change event
                    $('#country').change();

                    remove_error();
                }
            });
        });

        /* Returns calling code value */
        function get_calling_code(country) {
            var callingCodes = {!! json_encode(App\country::getCountryCodes()) !!}

            return callingCodes[country]+'|'+country;
        }

         /* Removes error class as semantic does not detect change on error */
         function remove_error() {

            var postal = $('#postal'),
                postalParent = postal.parent('.field'),
                callingCodeParent = $('#callingCodeDropdown').parent('.field');

            if(postalParent.hasClass('error') && (postal.val()).trim() != '') {
                postalParent.removeClass('error');
            }

            if(callingCodeParent.hasClass('error')) {
                callingCodeParent.removeClass('error');
            }

        }
    </script>
@endsection
