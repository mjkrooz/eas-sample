@extends('sourceblock::layouts.primary.page_lead', [
    'subtitle' => trans('tools::app/nav.main.title'),
    'page_lead_title' => trans('tools::app/nav.main.title'),
    'page_lead_description' => trans('home::app/main.leads.tools'),
    'page_lead_icon' => 'fas fa-tools'
])

@push('css-per')
    <style>
        /*https://fonts.googleapis.com/css?family=Open+Sans|Oxygen|Roboto|Abel|Didact+Gothic|Crimson+Text"*/

        .sb-tool-belt .card>.card-header {
            background-color: #004d40;
        }

        .custom-file-label::after {
            border-radius: 0 !important;
        }

        .nav-pills .nav-link {
            font-family: "Oxygen", sans-serif !important;
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

@section('sub-content')
    <!-- PRIMARY CONTENT -->

    <div class="row">

        {{-- The navigation for the tabs that list tools. --}}

        <div class="col-md-3">
            @include('tools::navs.tabs-nav')
        </div>

        {{-- The listing of tools on a per-tab basis. --}}

        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">

                {{-- FEATURED --}}

                <div class="tab-pane fade {{ !in_array(Request::route()->getName(), ['tools:data-packs', 'tools:resource-packs', 'tools:other']) ? 'show active' : '' }}" id="v-pills-featured" role="tabpanel" aria-labelledby="v-pills-featured-tab">

                    @include('tools::navs.tabs.tab-featured')
                </div>

                {{-- DATA PACKS --}}

                <div class="tab-pane fade {{ Request::route()->getName() === 'tools:data-packs' ? 'show active' : '' }}" id="v-pills-data-packs" role="tabpanel" aria-labelledby="v-pills-data-packs-tab">

                    @include('tools::navs.tabs.tab-data-packs')
                </div>

                {{-- RESOURCE PACKS --}}

                <div class="tab-pane fade {{ Request::route()->getName() === 'tools:resource-packs' ? 'show active' : '' }}" id="v-pills-resource-packs" role="tabpanel" aria-labelledby="v-pills-resource-packs-tab">

                    @include('tools::navs.tabs.tab-resource-packs')
                </div>

                {{-- OTHER --}}

                <div class="tab-pane fade {{ Request::route()->getName() === 'tools:other' ? 'show active' : '' }}" id="v-pills-other" role="tabpanel" aria-labelledby="v-pills-other-tab">

                    @include('tools::navs.tabs.tab-other')
                </div>
            </div>
        </div>
    </div>
@endsection
