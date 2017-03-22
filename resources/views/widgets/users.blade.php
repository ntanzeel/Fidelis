@push('stylesheets')
<link href="{{ asset('assets/css/layouts/default/widgets/users.css') }}" rel="stylesheet">
@endpush

<div class="panel panel-default">
    <div class="panel-heading">Who to follow?</div>
    <div class="panel-body">
        @forelse($recommendations as $recommendation)
            <div class="recommendation">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object avatar" src="{{ $recommendation->photo }}" alt="Generic placeholder image">
                    </a>
                </div>
                <div class="media-body">
                    <a class="author media-heading overflow" href="{{ route('profile.view', [$recommendation->username]) }}">
                        <strong class="full-name author-name">{{ $recommendation->name }}</strong>
                        <span class="username author-username">&commat;{{ $recommendation->username }}</span>
                    </a>

                    <ul class="list-inline list-unstyled action-list">
                        <li><a href="#" class="action action-like"><i class="fa fa-user-plus fa-lg"></i></a></li>
                        <li><a href="#" class="action action-dislike"><i class="fa fa-user-times fa-lg"></i></a></li>
                    </ul>

                </div>
            </div>
        @empty
            You have no recommendations
        @endforelse
    </div>
</div>