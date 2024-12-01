@extends('sourceblock::layouts.primary.page_lead', [
    'page_lead_title' => 'Raycasting Generator',
    'page_lead_description' => 'Create a raycasting data pack based on vdvman1\'s <a href="https://discordapp.com/channels/154777837382008833/157097006500806656/537829416894595083" target="_blank">raycasting template</a>. View the original <a href="https://skylinerw.com/vdvman1/raycast/" target="_blank">here</a>.',
    'page_lead_icon' => 'fas fa-chess-queen'
])

@push('css-per')

    <style>
        #raycastingTabMenu button.active {
            border-left-width: 3px;
            border-left-color: #007bff !important;
        }

        .selectpicker ~ button.btn-light {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .selectpicker ~ .dropdown-menu {
            z-index: 2000 !important;
        }

        .hover-info {
            border: 0px !important;
            border-bottom: 2px dotted #222222 !important;
            cursor: help;
        }

        #detectionMethodSelection .btn.active, #raycastingTabMenu .btn.active {
            box-shadow: none !important;
        }

        .sb-required > span::after {
            content: '*';
        }
    </style>
@endpush

@section('sub-content2')
    <div id="raycastingGenerator">
        <generator></generator>
    </div>
@endsection

@push('css-per')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ css_asset('tools/generators/raycasting/raycasting', 'primary') }}">

    <style type="text/css">
        #raycastingGeneratorOriginalSubmit:disabled {
            cursor: not-allowed;
        }
    </style>
@endpush

@push('js-after')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="{{ js_asset('tools/generators/raycasting/raycasting', 'primary') }}" async defer></script>

    {{--  Include x-templates to keep all the big stuff in Blade.  --}}

{{--    @include('sourceblock::primary.assets.js.x-template', ['xTemplateID' => 'xTabDetection', 'xTemplate' => 'tools::chunks.generators.raycasting.tab_detection'])--}}
@endpush

@section('sub-content')
    <div id="raycastingGenerator">

        <form action="{{ route('tools:data-packs/raycasting-generator') }}" v-on:submit.prevent="generate().submit()" method="POST" id="raycastingGeneratorForm">

            @csrf

            <div class="row">
                <div class="col-md-3">
                    <div id="raycastingTabMenu" class="nav" role="tablist">

                        <!-- Options tab button -->

                        <button class="btn btn-light rounded-0 w-100 nav-link mb-2" data-toggle="tab" href="#raycastingoptions" role="tab" aria-controls="raycastingoptions" aria-selected="false">
                            <i class="fas fa-exclamation-triangle mr-2 text-danger" v-if="errors().hasOptionErrors()" v-cloak></i>
                            Options
                        </button>

                        <!-- Detection tab button -->

                        <button class="btn btn-light rounded-0 w-100 nav-link mb-2 active" data-toggle="tab" href="#raycastingdetection" role="tab" aria-controls="raycastingdetection" aria-selected="true">
                            <i class="fas fa-exclamation-triangle mr-2 text-danger" v-if="errors().hasDetectionErrors()" v-cloak></i>
                            Detection
                        </button>

                        <!-- Optional commands tab button -->

                        <button class="btn btn-light rounded-0 w-100 nav-link mb-4" data-toggle="tab" href="#raycastingcommands" role="tab" aria-controls="raycastingcommands" aria-selected="false">
                            <i class="fas fa-exclamation-triangle mr-2 text-danger" v-if="errors().hasOptionalCommandErrors()" v-cloak></i>
                            Optional Commands
                        </button>

                        <button class="btn btn-info rounded-0 w-100 mb-2 d-none">View Guide</button>

                        <button type="submit" v-bind:class="!errors().hasErrors() ? '' : 'btn-warning text-dark'" id="raycastingGeneratorOriginalSubmit" class="btn rounded-0 w-100 btn-lg mb-2 btn-success">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-exclamation-triangle mr-2" v-if="errors().hasErrors()" v-cloak></i>
                                <div>Generate</div>
                                <div class="spinner-border ml-2" v-if="state.submitting" role="status" v-cloak></div>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="col-md-9 tab-content" id="raycastingTabs">
                    <div class="tab-pane" id="raycastingoptions" role="tabpanel" aria-labelledby="raycastingoptions-tab">
                        @include('tools::chunks.generators.raycasting.tab_options')
                    </div>
                    <div class="tab-pane show active" id="raycastingdetection" role="tabpanel" aria-labelledby="raycastingdetection-tab">
                        @include('tools::chunks.generators.raycasting.tab_detection')
                    </div>
                    <div class="tab-pane" id="raycastingcommands" role="tabpanel" aria-labelledby="raycastingcommands-tab">
                        @include('tools::chunks.generators.raycasting.tab_commands')
                    </div>
                </div>
            </div>

            @include('tools::chunks.generators.raycasting.generate_modal')
        </form>
    </div>
@endsection
