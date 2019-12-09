@extends('layouts.storefront')

@section('content')

    @if ($notification = session('notification'))
        <div class="ui container grid">
            <div class="column wide">
                {{ show_notification($notification['message'],$notification['type']) }}
            </div>
        </div>
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
                                    <td colspan="3">{{ __('translations.labels.shipping') }} <span class="pull-right">{{  __('translations.texts.free') }}</span></td>
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
                    <p>{{ __('translations.headings.uses_crypto',['ticker' => App\cryptocurrency::$ticker]) }}</p>
                    <div class="mb-2">
                        <svg width="94" height="94" viewBox="0 0 94 94" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <a href="#" class="svg-fallback">
                                <path d="M93.8878 46.5833C93.8878 38.3333 91.6378 30.4583 87.5128 23.3333C83.3878 16.2083 77.7628 10.5833 70.6378 6.45825C63.5128 2.33325 55.6378 0.083252 47.3878 0.083252C38.9503 0.083252 31.2628 2.33325 24.1378 6.45825C17.0128 10.5833 11.2003 16.2083 7.07532 23.3333C2.95032 30.4583 0.887817 38.3333 0.887817 46.5833C0.887817 55.0208 2.95032 62.7083 7.07532 69.8333C11.2003 76.9583 17.0128 82.7708 24.1378 86.8958C31.2628 91.0208 38.9503 93.0833 47.3878 93.0833C55.6378 93.0833 63.5128 91.0208 70.6378 86.8958C77.7628 82.7708 83.3878 76.9583 87.5128 69.8333C91.6378 62.7083 93.8878 55.0208 93.8878 46.5833ZM67.2628 40.0208C66.5128 44.1458 64.4503 46.7708 60.8878 47.5208C65.7628 50.1458 67.4503 54.2708 65.5753 59.8958C64.0753 63.6458 61.8253 65.8958 58.8253 66.8333C56.0128 67.7708 52.2628 67.7708 47.5753 66.6458L45.3253 75.0833L40.2628 73.9583L42.3253 65.5208L38.3878 64.5833L36.1378 72.8333L31.0753 71.5208L33.1378 63.0833L23.0128 60.4583L25.4503 54.6458C27.8878 55.3958 29.2003 55.7708 29.2003 55.5833C30.3253 55.9583 31.0753 55.5833 31.4503 54.4583L34.8253 40.9583L35.3878 41.1458L34.8253 40.9583L37.2628 31.3958C37.2628 29.8958 36.5128 28.9583 34.8253 28.3958C34.8253 28.3958 34.2628 28.3958 33.1378 28.0208L31.2628 27.6458L32.5753 22.2083L42.8878 24.6458L44.9503 16.2083L50.0128 17.5208L47.9503 25.7708L52.0753 26.7083L54.1378 18.6458L59.2003 19.7708L57.1378 28.2083C60.5128 29.5208 63.1378 31.0208 65.0128 32.5208C66.8878 34.7708 67.6378 37.2083 67.2628 40.0208ZM55.6378 56.3333C56.2003 53.7083 55.0753 51.6458 52.0753 49.9583C50.2003 49.2083 47.5753 48.2708 44.0128 47.3333L42.7003 47.1458L39.8878 58.3958L41.0128 58.5833C44.5753 59.7083 47.3878 60.0833 49.2628 60.0833C52.8253 60.0833 54.8878 58.9583 55.6378 56.3333ZM57.3253 39.8333C57.7003 37.5833 56.7628 35.7083 54.3253 34.2083C52.8253 33.4583 50.5753 32.7083 47.5753 31.9583L46.6378 31.7708L44.0128 41.8958L44.9503 42.2708C47.9503 43.0208 50.2003 43.3958 51.8878 43.3958C54.8878 43.3958 56.5753 42.0833 57.3253 39.8333Z" fill="#F7941D"/>
                            </a>
                            <image src="{{ asset('images/bitcoin.png') }}" xlink:href="#">
                        </svg>
                    </div>
                    <div class="payment-alert__notification payment-alert__notification--info">
                        <p class="mb-0">{{ __('translations.texts.refresh') }}</p>
                        <p class="mb-0">{{ __('translations.texts.seconds_to_confirm') }}</p>
                        <p>{{ __('translations.texts.minutes_to_exchange',['tickerSymbol' => App\cryptocurrency::$ticker_symbol]) }}</p>
                    </div>
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
                <form action="{{ action('PaymentController@check')}}" method="POST" id="payment-sent-form" class="mt-1">
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
