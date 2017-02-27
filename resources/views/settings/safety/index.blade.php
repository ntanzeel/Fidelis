@extends('settings.layout', ['title' => 'Privacy &amp; Safety Settings'])

@push('frameworks.stylesheets')
    <link href="{{ asset('assets/css/frameworks/bootstrap-slider/9.7.2.css') }}" rel="stylesheet">
@endpush

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('settings.safety.store') }}">
        {{ csrf_field() }}

        @include('settings.safety.partials.safety-form', compact('settings'))
        @include('settings.safety.partials.privacy-form', compact('settings'))

        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <button type="submit" class="btn btn-orange">Save Changes</button>
            </div>
        </div>
    </form>
@stop

@push('frameworks.scripts')
    <script src="{{ asset('assets/js/frameworks/bootstrap-slider/9.7.2.min.js') }}"></script>
@endpush