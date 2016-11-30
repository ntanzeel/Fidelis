@push('stylesheets')
<link href="{{ asset('assets/css/layouts/default/widgets/trending.css') }}" rel="stylesheet">
@endpush

<div class="panel panel-default">
    <div class="panel-heading">Trends</div>
    <div class="panel-body">
        <ul class="list-unstyled margin-0">
            @if($trends[0]->posts_count == 0)
                Nothing is trending...
            @else
                @foreach($trends as $trend)
                    @if($trend->posts_count > 0)
                        <li class="row-trend">
                            <a class="hash-tag"
                               href="{{ route("discover.category", $trend->text) }}">{{ $trend->text }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>