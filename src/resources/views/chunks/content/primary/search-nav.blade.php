@push('css-per')
    <style>
        .search-text {
            padding-top: 1.5em !important;
            padding-bottom: 1.5em !important;
        }

        .search-text-sm {
            padding-top: 1.4em !important;
            padding-bottom: 1.4em !important;
        }

        #searchInputs input, #searchInputs button {
            background-color: rgba(240, 240, 240, 1) !important;
        }

        .btn:focus, .form-control:focus, .custom-select:focus {
            outline: none;
            border-color: inherit;
            -webkit-box-shadow: none;
            -webkit-box-shadow: inset 0px 0px 0.25rem 0.2rem rgba(25, 25, 25, 0.4);
            -moz-box-shadow: inset 0px 0px 0.25rem 0.2rem rgba(25, 25, 25, 0.4);
            box-shadow: inset 0px 0px 0.25rem 0.2rem rgba(25, 25, 25, 0.4);
        }

        .search-text::placeholder, .search-text-sm::placeholder {
            font-family: "Open Sans" !important;
        }

        .search-text-sm::placeholder {
            color: #555555;
        }
    </style>
@endpush

@if (\Request::route()->named('home'))
    <div class="jumbotron jumbotron-fluid bg-transparent text-dark mb-0">
        <div class="container text-center py-5">
            <div class="row mt-3 pt-4 pb-5">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg bg-light border-0 pl-4 search-text"
                            placeholder="Search all databases..." aria-label="Search"
                            aria-describedby="button-addon4" style="border-radius: 25px 0px 0px 25px !important;">
                        <div class="input-group-append" id="button-addon4">
                            {{-- <button class="btn btn-primary" type="button"><i class="fas fa-cogs"></i></button> --}}
                            <button class="btn btn-light border-0" type="button" data-toggle="tooltip"
                                data-placement="top" title="Advanced options"><i class="fas fa-cogs"></i></button>
                            <button class="btn btn-light border-0 px-3" type="button"
                                style="border-radius: 0px 25px 25px 0px !important;"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container text-right">
        <div class="row align-bottom">
            <div class="col-12 col-lg-5 offset-lg-7">
                <div id="searchInputs" class="input-group shadow" style="border-radius: 0px 0px 25px 25px;">
                    <input type="text" class="form-control text-dark border-0 pl-4 search-text-sm"
                        placeholder="Search all databases..." aria-label="Search"
                        aria-describedby="button-addon4" style="border-radius: 0px 0px 0px 25px !important;">
                    <div class="input-group-append ml-0" id="button-addon4">
                        {{-- <button class="btn btn-primary" type="button"><i class="fas fa-cogs"></i></button> --}}
                        <button class="btn btn-light border-0" type="button" data-toggle="tooltip"
                            data-placement="top" title="Advanced options"><i class="fas fa-cogs"></i></button>
                        <button class="btn btn-light border-0 px-3 ml-0" type="button"
                            style="border-radius: 0px 0px 25px 0px !important;"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('sourceblock::chunks.content.primary.breadcrumb-nav')
            </div>
        </div>
    </div>
@endif