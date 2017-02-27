<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a class="{{ $title=="Profile Settings" ? 'active' : "" }}" href="{{ route('settings.account.index') }}">Profile Settings</a></li>
            <li role="presentation"><a class="{{ $title=="Privacy &amp; Safety Settings" ? 'active' : "" }}" href="{{ route('settings.safety.index') }}">Privacy &amp; Safety Settings</a></li>
            <li role="presentation"><a class="{{ $title=="Manage Subscriptions" ? 'active' : "" }}" href="{{ route('settings.subscriptions.index') }}">Manage Subscriptions</a></li>
        </ul>
    </div>
</div>