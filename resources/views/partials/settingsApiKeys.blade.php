<div class="ui bottom attached tab segment {{ (session('settingsTab') === 'apiKeys' || session('settingsTab') === null) ? 'active': '' }}" data-tab="first">
    <div class="nexmo-settings">
        <h3>{{ __('translations.headings.nexmo') }}</h3>
        <form  method="POST" action="{{ action('SettingsController@updateNexmoKeys') }}" class="ui form nexmo-form">
            @csrf
            <div class="three fields">
                <div class="field {{ ($errors->first('nexmoKey')) ? 'error' : '' }}">
                    <label for="nexmoKey">{{ __('translations.labels.key') }}</label>
                    <input id="nexmoKey" type="text" class="input" name="nexmoKey" value="{{ old('nexmoKey',(isset($settings['nexmo']['value']['key'])) ? 'CURRENTLY SET' : '') }}">
                </div>
                <div class="field {{ ($errors->first('nexmoSecret')) ? 'error' : '' }}">
                    <label for="nexmoSecret">{{ __('translations.labels.secret') }}</label>
                    <input id="nexmoSecret" type="text" class="input" name="nexmoSecret" value="{{ old('nexmoSecret',(isset($settings['nexmo']['value']['secret'])) ? 'CURRENTLY SET' : '') }}">
                </div>
                <div class="field {{ ($errors->first('smsFrom')) ? 'error' : '' }}">
                    <label for="smsFrom">{{ __('translations.labels.sms_from') }}</label>
                    <input id="smsFrom" type="text" class="input" name="smsFrom" value="{{ old('smsFrom',(isset($settings['nexmo']['value']['sms_from'])) ? 'CURRENTLY SET' : '') }}">
                </div>
            </div>
            <div class="field group">
                <button class="ui red button right floated" type="submit">{{ __('translations.buttons.save') }}</button>
            </div>
        </form>
    </div>
    <div class="ui divider"></div>
    <div class="gemini-settings">
        <h3>{{ __('translations.headings.gemini') }}</h3>
        <form  method="POST" action="{{ action('SettingsController@updateGeminiKeys') }}" class="ui form gemini-form">
            @csrf
            <div class="two fields">
                <div class="field {{ ($errors->first('geminiKey')) ? 'error' : '' }}">
                    <label for="geminiKey">{{ __('translations.labels.key') }}</label>
                    <input id="geminiKey" type="text" class="input" name="geminiKey" value="{{ old('geminiKey',(isset($settings['gemini']['value']['key'])) ? 'CURRENTLY SET' : '') }}">
                </div>
                <div class="field {{ ($errors->first('geminiSecret')) ? 'error' : '' }}">
                    <label for="geminiSecret">{{ __('translations.labels.secret') }}</label>
                    <input id="geminiSecret" type="text" class="input" name="geminiSecret" value="{{ old('geminiSecret',(isset($settings['gemini']['value']['secret'])) ? 'CURRENTLY SET' : '') }}">
                </div>
            </div>
            <div class="field group">
                <button class="ui red button right floated" type="submit">{{ __('translations.buttons.save') }}</button>
            </div>
        </form>
    </div>
</div>