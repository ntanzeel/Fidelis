<div class="panel panel-default">
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation">
                <a class="{{ $active == "Subscribed" ? 'active' : '' }}"
                   href="{{ route('discover.index') }}">Subscribed</a>
            </li>
            <li role="presentation">
                <a class="{{ $active == "Recommendations" ? 'active' : '' }}"
                   href="{{ route('discover.category', 'Recommendations') }}">Recommendations</a>
            </li>
            @foreach($categories as $category)
                <li role="presentation">
                    <a class="{{ $active == $category->name ? 'active' : '' }}"
                       href="{{ route('discover.category', [$category->name]) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>