@extends('layouts.admin')

@section('content')
    <div class="ui card fluid">
        <div class="content">
            <div class="header">
                <h2 class="ui header">{{ __('translations.headings.sent_shipment') }}</h2>
            </div>
        </div>
        <div class="content">
            <table class="ui celled table table-break">
                <thead>
                    <th>{{ __('translations.labels.order_no') }}</th>
                    <th>{{ __('translations.headings.qty') }}</th>
                    <th>{{ __('translations.headings.carrier') }}</th>
                    <th>{{ __('translations.labels.tracking_number') }}</th>
                    <th>{{ __('translations.labels.name') }}</th>
                    <th>{{ __('translations.labels.country') }}</th>
                    <th>{{ __('translations.labels.state') }}</th>
                    <th>{{ __('translations.labels.city') }}</th>
                    <th>{{ __('translations.labels.postal') }}</th>
                    <th>{{ __('translations.labels.address_1') }}</th>
                    <th>{{ __('translations.labels.address_2') }}</th>
                    <th>{{ __('translations.labels.phone') }}</th>
                    <th class="right aligned three wide">{{ __('translations.labels.options') }}</th>
                </thead>
                <tbody>
                    @if($sent->count())
                        @foreach($sent as $shipment)
                            <tr>
                                <td class="break-word">{{ $shipment->order_number }}</td>
                                <td class="break-word">{{ $shipment->qty }}</td>
                                <td class="break-word">{{ $shipment->carrier['name'] }}</td>
                                <td class="break-word">{{ $shipment->tracking_number }}</td>
                                <td class="break-word">{{ $shipment->name }}</td>
                                <td class="break-word">{{ $shipment->country }}</td>
                                <td class="break-word">{{ $shipment->state }}</td>
                                <td class="break-word">{{ $shipment->city }}</td>
                                <td class="break-word">{{ $shipment->postal }}</td>
                                <td class="break-word">{{ $shipment->address1 }}</td>
                                <td class="break-word">{{ $shipment->address2 }}</td>
                                <td class="break-word">{{ $shipment->phone }}</td>
                                <td class="group">
                                    <form method="GET" action="{{ action('AdminController@delete') }}" class="ui right floated" onSubmit="return confirm('{{ __('translations.texts.delete_confirm') }} {{ $shipment->name }}');">
                                        <input type="hidden" name="delete" value="{{ $shipment->id }}" />
                                        <button class="mini ui red button">{{ __('translations.buttons.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="13" class="text-center">{{ __('translations.texts.no_sent') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.modals.ordersInfoModal')
@endsection