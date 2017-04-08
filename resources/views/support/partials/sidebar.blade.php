<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a class="{{ $title == "Support" ? 'active' : "" }}" href="{{ route('support.index') }}">Support</a></li>
            <li role="presentation"><a class="{{ $title == "Terms" ? 'active' : "" }}" href="{{ route('support.terms') }}">Terms</a></li>
        </ul>
    </div>
</div>
