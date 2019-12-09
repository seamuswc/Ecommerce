@extends('layouts.storefront')

@section('content')
    <div class="ui container grid content-wrapper">
        <div class="sixteen wide mobile eight wide tablet eight wide computer column centered middle aligned">
            <div class="text-center payment-success">
                <h3 class="payment-success__heading">{{ __('translations.headings.payment_success') }}</h3>
                <p> {{ __('translations.texts.shipping_time') }} <strong> {{ $confirmed['city'] }}, {{  __('translations.countries.'.string_to_key($confirmed['country']))  }}</strong></p>
                <p>{{ __('translations.texts.order_number') }}</p>
                <div class="payment-success__order-no">
                    {{ $confirmed['order_number'] }}
                </div>
                <div class="ui divider"></div>
                <div class="ui items">
                    <div class="item">
                        <div class="content text-center">
                            <h3 class="ui header text-uppercase mt-0 mb-2">{{ __('translations.headings.order_summary') }}</h3>
                            <table class="order-summary mb-3">
                                <tr>
                                    <td>{{ $confirmed['product']->name }}</td>
                                    <td>{{ $confirmed['qty'] }}</td>
                                    <td>{{__('translations.labels.currency_symbol').$confirmed['total']['local'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">{{ __('translations.labels.shipping') }} <span class="pull-right">{{  __('translations.texts.free') }}</span></td>
                                </tr>
                                <tr class="order-summary__total">
                                    <td colspan="3">
                                        <strong>{{ __('translations.texts.total') }}</strong>
                                        <strong class="pull-right">{{ __('translations.labels.currency_symbol').$confirmed['total']['local'] }} ({{ App\cryptocurrency::$ticker_symbol }} {{ number_format($confirmed['total']['crypto'],6)}} )</strong>
                                    </td>
                                </tr>
                            </table>
                            <a href="{{ URL::to('/') }}"class="ui button button--primary button--fixed">{{ __('translations.buttons.continue_shopping') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" ref="paymentConfirmed" value="1">
@endsection
