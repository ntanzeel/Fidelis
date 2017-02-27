<fieldset>
    <legend>Safety Settings</legend>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="abuse_rating" class="col-md-2 control-label">Abuse Rating</label>
        <div class="col-md-10">
            <input
                    type="text"
                    id="abuse_rating"
                    name="abuse_rating"
                    data-provide="slider"
                    data-slider-min="25"
                    data-slider-max="100"
                    data-slider-step="1"
                    data-slider-value="{{ !empty($settings['abuse_rating']) ? $settings['abuse_rating']->value : 75 }}"
            >
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</fieldset>