<div class="panel panel-default">
    <div class="panel-heading">{{ Auth::user()->name }}</div>
    <div class="panel-body">
        <ul>
            <li><strong>Followers: {{ Auth::user()->followers()->count() }}</strong></li>
            <li><strong>Following: {{ Auth::user()->following()->count() }}</strong></li>
        </ul>
    </div>
</div>