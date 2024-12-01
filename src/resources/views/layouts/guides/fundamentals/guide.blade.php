@extends('sourceblock::layouts.secondary')

@push('css-per')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/styles/a11y-dark.min.css">

    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oxygen|Roboto|Abel|Didact+Gothic|Crimson+Text" -->
    <!-- rel="stylesheet"> -->
    <style>
        #guideContent > p, .sb-guide-modal-content > p {
            font-family: 'Open Sans';
        }

        #guideContent p > code {

            background-color: #d9dde2;
            padding: 5px;
            color: #121212 !important;
        }

        #guideContent code a.sb-guide-link {
            border: none !important;
            margin: 4px;
            padding: 0px;
        }

        #guideContent code a.sb-guide-link:hover {
            border: none !important;
            margin: 4px;
            padding: 0px;
            background-color: transparent !important;
            color: #777777;
        }

        #guideContent > pre, .sb-guide-modal-content > pre {
            margin-bottom: 1.25rem !important;
        }

        #guideToc .nav-pills .nav-link {
            font-family: "Roboto" !important;
            font-size: 1.0rem !important;
        }
    </style>
@endpush

@section('subcontent')
    <!-- PRIMARY CONTENT -->

    {{-- Tabs --}}
    @hasSection('guide-navigation-tabs')
        <div class="mb-4">
            @yield('guide-navigation-tabs')
        </div>
    @endif

    {{-- TOC+grid+guide --}}
    @hasSection('guide-navigation-toc')
        @if(isset($toc_float) && $toc_float)
        <div class="clearfix">
            <div class="float-left mr-4 mb-4">
                <nav id="guideToc" class="px-3 mb-3">
                    @yield('guide-navigation-toc')
                </nav>
                @if(isset($grid_menu))
                    <nav class="p-3">
                        @include('sourceblock::chunks.menus.guides.fundamentals.grid')
                    </nav>
                @endif
            </div>
            <div id="guideContent" class="position-relatidve float-rigdht">
                @yield('guide')
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-3">
                    <nav id="guideToc" class="px-3 mb-3">
                        @yield('guide-navigation-toc')
                    </nav>
                    @if(isset($grid_menu))
                        @include('sourceblock::chunks.menus.guides.fundamentals.grid')
                    @endif
                </div>
                <div class="col-md-9">
                    <div id="guideContent" class="position-relative">
                        @yield('guide')
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- grid+guide --}}
        @if(isset($grid_menu))
            <div class="row">
                <div class="col-md-3">
                    @include('sourceblock::chunks.menus.guides.fundamentals.grid')
                </div>
                <div class="col-md-9">
                    <div id="guideContent" class="position-relative">
                        @yield('guide')
                    </div>
                </div>
            </div>
        {{-- Just guide --}}
        @else
            <div id="guideContent" class="position-relative">
                @yield('guide')
            </div>
        @endif
    @endif

    @stack('after-guide')
@endsection

@push('js-after')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
    {{-- <script>
        $(document).ready(function() {

            $('body').scrollspy({
                target: '#toc',
                offset: 40
            });
        });
    </script> --}}
@endpush