@extends('sourceblock::layouts.primary')

@push('css-per')
<style>
    /*https://fonts.googleapis.com/css?family=Open+Sans|Oxygen|Roboto|Abel|Didact+Gothic|Crimson+Text"*/

    .sb-tool-belt .card>.card-header {
        background-color: #004d40 !important;
    }

    .custom-file-label::after {
        border-radius: 0px !important;
    }

    .nav-pills .nav-link {
        font-family: "Oxygen" !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: #fcfcfc;
        color: #000;
        border-left: 1px #bdbdbd solid;
    }

    .sb-tool-evaluator {
        background-color: #b2ebf2 !important;
    }

    #v-pills-resource-packs .sb-tool-belt .card-header {
        background-color: #2e7d32 !important;
    }
</style>
@endpush


@push('js-after')
<script>
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        console.log(e.target);
        
        history.replaceState('', 'Source Block - Tools (' + e.target.innerText + ')', e.target.dataset.tabLink);
    })
</script>
@endpush

@section('content')
<!-- PRIMARY CONTENT -->

<div class="row mb-3">
    <div class="col-2 text-center">
        <i class="fas fa-tools display-4 text-info"></i>

    </div>
    <div class="col-10">
        <h3 class="font-weight-bold">Tools</h3>
        <p class="lead">Make use of database content to generate or evaluate command-relevant features.</p>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-3">
        @include('sourceblock::chunks.content.tools.tabs-menu')
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade{{ !in_array(Request::route()->getName(), ['tools:data-packs', 'tools:resource-packs', 'tools:other']) ? 'show active' : '' }}" id="v-pills-featured" role="tabpanel" aria-labelledby="v-pills-featured-tab">

                {{-- FEATURED --}}
                
                @include('sourceblock::chunks.content.tools.tab-featured')
            </div>
            <div class="tab-pane fade{{ Request::route()->getName() === 'tools:data-packs' ? 'show active' : '' }}" id="v-pills-data-packs" role="tabpanel" aria-labelledby="v-pills-data-packs-tab">

                {{-- DATA PACKS --}}

                @include('sourceblock::chunks.content.tools.tab-data-packs')
            <div class="tab-pane fade{{ Request::route()->getName() === 'tools:resource-packs' ? 'show active' : '' }}" id="v-pills-resource-packs" role="tabpanel"
                aria-labelledby="v-pills-resource-packs-tab">

                {{-- RESOURCE PACKS --}}

                @include('sourceblock::chunks.content.tools.tab-resource-packs')
            </div>
            <div class="tab-pane fade{{ Request::route()->getName() === 'tools:other' ? 'show active' : '' }}" id="v-pills-other" role="tabpanel" aria-labelledby="v-pills-other-tab">

                {{-- OTHER --}}

                @include('sourceblock::chunks.content.tools.tab-other')
            </div>
        </div>
    </div>
</div>
@endsection