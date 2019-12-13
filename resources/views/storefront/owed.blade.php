@extends('layouts.storefront')

@section('page-title', 'Owed')

@section('content')

    @if ($notification = session('notification'))
        <div class="ui container grid">
            <div class="column wide">
                {{ show_notification($notification['message'],$notification['type']) }}
            </div>
        </div>
        @php($address =session('address'))
    @endif
    <div class="ui container grid content-wrapper">
        <div class="row">
            <div class="sixteen wide mobile eight wide tablet eight wide computer column">
                <div class="ui items">
                    <div class="item">
                        <div class="content text-center">
                            <h3 class="ui header text-uppercase mt-0 mb-2">{{ __('translations.headings.order_summary') }}</h3>
                            <table class="order-summary">
                                <tr>
                                    <td>{{ $shipping['product']->name }}</td>
                                    <td>{{ $shipping['qty'] }}</td>
                                    <td>{{ __('translations.labels.currency_symbol').$shipping['product']->price }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">{{ __('translations.labels.shipping') }} <span class="pull-right">{{ __('translations.texts.free') }}</span></td>
                                </tr>
                                <tr class="order-summary__total">
                                    <td colspan="3">
                                        <strong>{{ __('translations.texts.total') }}</strong>
                                        <strong class="pull-right">{{__('translations.labels.currency_symbol') }}{{ number_format($shipping['total']['local']) }} ({{ App\cryptocurrency::$ticker_symbol." ".$shipping['total']['crypto'] }})</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sixteen wide mobile eight wide tablet eight wide computer column">
                <div class="payment-alert mt-3 text-center">
                    <div class="payment-alert__notification payment-alert__notification--info mb-1">
                        <h3>{{ number_format($owed,6) }} {{ __('translations.headings.payment_owed',['tickerSymbol' => App\cryptocurrency::$ticker_symbol]) }}</h3>
                    </div>
                    <p class="mb-0">{{ __('translations.texts.send_remaining') }}</p>
                    <p class="mb-0">{{ __('translations.texts.send_again') }} </p>
                    <p>{{ __('translations.texts.minutes_to_exchange',['tickerSymbol' => App\cryptocurrency::$ticker_symbol]) }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sixteen wide mobile eight wide tablet eight wide computer centered column text-center">
                <h3 class="ui header text-uppercase mt-2 mb-1">{{ __('translations.headings.crypto_address',['ticker' => App\cryptocurrency::$ticker]) }}</h3>
                <div class="mb-2">
                    <a id="crypto-address" class="ui header small color--green-2 break-word" href="{{ App\cryptocurrency::checkWallet($address)}}" target="_blank">{{$address}}</a>
                </div>
                <div id="qrcode" class="mb-2"></div>
                <form action="{{ action('PaymentController@check')}}"  method="POST" id="payment-sent-form" class="mt-1">
                    @csrf
                    <input type="hidden" name="rate" value="{{ $shipping['total']['crypto'] }}">
                    <input type="hidden" name="address" value="{{$address}}">
                    <button class="ui button button--primary button--fixed">{{ __('translations.buttons.payment_sent') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page-script-before')
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script src="{{ asset('js/qrgenerate.js') }}"></script>
@endsection
