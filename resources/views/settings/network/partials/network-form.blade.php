<fieldset>
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
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="recommendation_preference" class="col-md-2 control-label">Recommendation Preference</label>
        <div class="row">
            <div class="col-sm-1">
                <input type="radio" name="recommendation_preference"
                       value="Explorer" {{ $settings['recommendation_preference']->value == 'Explorer' ?  'checked' : ''}}>Explorer
            </div>
            <div class="col-sm-1">
                <input type="radio" name="recommendation_preference"
                       value="FOF" {{ $settings['recommendation_preference']->value == 'FOF' ?  'checked' : ''}}>Friend-of-a-Friend
            </div>
            <div class="col-sm-1">
                <input type="radio" name="recommendation_preference"
                       value="Hybrid" {{ $settings['recommendation_preference']->value == 'Hybrid' ?  'checked' : ''}}>Hybrid
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="recommendation_number" class="col-md-2 control-label">Number of Recommendations</label>
        <div class="col-md-2">
            <input type="text"
                   value={{ !empty($settings['recommendation_number']->value) ? $settings['recommendation_number']->value : 5 }} class="form-control"
                   name="recommendation_number">
        </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="recommendation_threshold" class="col-md-2 control-label">Similarity Threshold</label>
        <div class="col-md-10">
            <input
                    type="text"
                    id="recommendation_threshold"
                    name="recommendation_threshold"
                    data-provide="slider"
                    data-slider-min="0.2"
                    data-slider-max="1"
                    data-slider-step="0.1"
                    data-slider-value="{{ !empty($settings['recommendation_threshold']) ? $settings['recommendation_threshold']->value : 0.6 }}"
            >
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="recommendation_reputation" class="col-md-2 control-label">Minimum Reputation</label>
        <div class="col-md-10">
            <input
                    type="text"
                    id="recommendation_reputation"
                    name="recommendation_reputation"
                    data-provide="slider"
                    data-slider-min="0"
                    data-slider-max="100"
                    data-slider-step="5"
                    data-slider-value="{{ !empty($settings['recommendation_reputation']) ? $settings['recommendation_reputation']->value : 25 }}"
            >
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="reputation_display" class="col-md-2 control-label">Reputation Display</label>
        <div class="row">
            <div class="col-sm-1">
                <input type="radio" name="reputation_display"
                       value="Bar" {{ $settings['reputation_display']->value == 'Bar' ?  'checked' : ''}}><br>Bar
            </div>
            <div class="col-sm-1">
                <input type="radio" name="reputation_display"
                       value="Stars" {{ $settings['reputation_display']->value == 'Stars' ?  'checked' : ''}}>Stars
            </div>
        </div>
    </div>
</fieldset>