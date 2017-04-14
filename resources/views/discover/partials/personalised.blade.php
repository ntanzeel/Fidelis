<div class="panel panel-default">
    <div class="panel-heading">For You</div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation">
                <a class="{{ $active == "Subscribed" ? 'active' : '' }}"
                   href="{{ route('discover.index') }}">Subscribed</a>
            </li>
            <li role="presentation">
                <a class="{{ $active == "Recommended" ? 'active' : '' }}"
                   href="{{ route('discover.recommended') }}">Recommended</a>
            </li>
        </ul>
    </div>
</div>