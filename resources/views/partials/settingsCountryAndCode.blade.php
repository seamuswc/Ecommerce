<div class="ui bottom attached tab segment {{ (session('settingsTab') === 'country') ? 'active': '' }}" data-tab="second">
    <form  method="POST" action="{{ action('CountryController@store') }}" class="ui form country-form">
        @csrf
        <div class="five fields">
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
                    <input type="text" id="callingCode" class="input" name="callingCode" value="{{ old('callingCode') }}"  @keypress="isNumber($event)" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                </div>
            </div>
            <div class="field {{ ($errors->first('import_tariff')) ? 'error' : '' }}">
                <label for="import_tariff">{{ __('translations.labels.import_tariff') }}</label>
                <div class="ui left icon input" data-children-count="1">
                    <i class="percent icon"></i>
                    <input type="text" id="import_tariff" class="input" name="import_tariff" value="{{ old('import_tariff') }}"  @keypress="isNumber($event)" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                </div>
            </div>

            <div class="field {{ ($errors->first('sales_tax')) ? 'error' : '' }}">
                <label for="sales_tax">{{ __('translations.labels.sales_tax') }}</label>
                <div class="ui left icon input" data-children-count="1">
                    <i class="percent icon"></i>
                    <input type="text" id="sales_tax" class="input" name="sales_tax" value="{{ old('sales_tax') }}"  @keypress="isNumber($event)" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
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
        <table class="ui celled table mt-3">
            <thead>
                <th>{{ __('translations.labels.country') }}</th>
                <th>{{ __('translations.labels.iso') }}</th>
                <th>{{ __('translations.labels.code') }}</th>
                <th>{{ __('translations.labels.import_tariff') }}</th>
                <th>{{ __('translations.labels.sales_tax') }}</th>
                <th>{{ __('translations.labels.shipping') }}</th>
                <th class="right aligned">{{ __('translations.labels.options') }}</th>
            </thead>
            <tbody>
                @foreach($supportedCountries as $supportedCountry)
                    <tr>
                        <td>{{ $supportedCountry->name }}</td>
                        <td>{{ $supportedCountry->iso }}</td>
                        <td>{{ $supportedCountry->calling_code }}</td>
                        <td>{{ $supportedCountry->import_tariff }}%</td>
                        <td>{{ $supportedCountry->sales_tax }}%</td>
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