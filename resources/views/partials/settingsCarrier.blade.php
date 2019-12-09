<div class="ui bottom attached tab segment {{ (session('settingsTab') === 'carrier') ? 'active': '' }}" data-tab="third">
    <form  method="POST" action="{{ action('CarrierController@store') }}" class="ui form carrier-form">
        @csrf
        <div class="field {{ ($errors->first('email')) ? 'error' : '' }}">
            <label for="carrier">{{ __('translations.labels.name') }}</label>
            <input type="text" id="carrier" class="input" name="carrier" value="{{ old('carrier') }}">
        </div>
        <div class="field group">
            <button class="ui red button right floated" type="submit">{{ __('translations.buttons.save') }}</button>
        </div>
    </form>
    @if($carriers->count())
        <table class="ui celled table mt-3">
            <thead>
                <th>{{ __('translations.labels.name') }}</th>
                <th class="right aligned">{{ __('translations.labels.options') }}</th>
            </thead>
            <tbody>
                @foreach($carriers as $carrier)
                    <tr>
                        <td>{{ $carrier->name }}</td>
                        <td class="group">
                            <form method="POST" action="{{ action('CarrierController@delete',['id'=>$carrier->id]) }}" class="ui right floated" onSubmit="return confirm('{{ __('translations.texts.delete_confirm') }} {{ $carrier->name }}?');">
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