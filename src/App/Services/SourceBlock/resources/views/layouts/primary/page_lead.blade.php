@extends('sourceblock::layouts.primary')

@section('content')
    <div class="row mb-3 mt-4">
        <div class="col-2 text-center">
            <i class="{{ $page_lead_icon }} display-4 text-info"></i>
        </div>
        <div class="col-10">
            <h3 class="font-weight-bold">{{ $page_lead_title }}</h3>
            <p class="lead">{!! $page_lead_description !!}</p>
        </div>
    </div>

    <hr>

    @yield('sub-content')
@endsection
