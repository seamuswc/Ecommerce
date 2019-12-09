<div id="tracking-number-modal" class="ui mini modal">
    <i class="close icon"></i>
    <div class="content">
        <h5 class="ui large header center aligned">{{ __('translations.headings.tracking_info') }}</h5>
        <form class="ui form">
            <div class="field">
                <label for="trackingNumberInput">{{ __('translations.labels.tracking_number') }}</label>
                <input type="hidden" id="shipmentFormId" value="0">
                <input type="text" id="trackingNumberInput" placeholder="Tracking Number">
            </div>
            <div class="field">
                <label for="carrier">{{ __('translations.headings.carrier') }}</label>
                <div class="ui fluid selection dropdown">
                    <input type="hidden" id="carrierDropdown" name="carrierDropdown" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">{{ __('translations.texts.select_carrier') }}</div>
                    <div class="menu">
                        @if($carriers->count())
                            @foreach($carriers as $carrier)
                                <div class="item" data-value="{{ $carrier->id }}">{{ $carrier->name }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="field group">
                <button type="button" id="trackingNumberButton" class="ui teal button right floated">{{ __('translations.buttons.sent') }}</button>
            </div>
        </form>
        
    </div>
</div>
