@extends('sourceblock::layouts.primary.page_lead', [
    'subtitle' => trans('guides::app/nav.main.title'),
    'page_lead_title' => trans('guides::app/nav.main.title'),
    'page_lead_description' => trans('home::app/main.leads.guides'),
    'page_lead_icon' => 'fas fa-book'
])
@section('sub-content')

    <div class="jumbotron text-light p-0 shadow" style="background: url('{{ image_asset("back_dark2.png", 'primary') }}');background-size: cover;">
        <div id="receiver" style="background-color: rgba(147, 112, 219, 0.45);">
            <div class="row">
                <div class="col-md-10 p-5">
                    <h1 class="display-2">Foundations</h1>
                    <hr class="bg-ligdht" style="background:rgba(255,255,255,0.35);">
                    <p class="lead">Official guides that cover the primary features for content creation.</p>
                </div>
                <div class="col-md-2 p-5 d-flex justify-content-center align-items-center text-center">
                    <a class="text-light stretched-link" href="#!" id="testest"><i class="fas fa-arrow-alt-circle-right fa-5x"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-light p-0 mt-5" style="background: url('{{ image_asset("back_light2.png", 'primary') }}');background-size: cover;">
        <div id="receiver2" style="background-color: rgba(250, 250, 250, 0.45);">
            <div class="row">
                <div class="col-md-10 p-5">
                    <h1 class="display-4">User guides</h1>
                    <hr style="background:rgba(0, 0, 0, 0.15);">
                    <p class="lead">Various guides created by the community that cover a wider variety of topics.</p>
                </div>
                <div class="col-md-2 p-5 d-flex justify-content-center align-items-center text-center">
                    <a class="text-dark stretched-link" href="#!" id="testest2"><i class="far fa-arrow-alt-circle-right fa-5x"></i></a>
                </div>
            </div>
        </div>
    </div>

    <p class="text-center font-italic">&lt;Insert popular user guides here&gt;</p>

@endsection

@push('js-after')


    <script>
        $('#testest').mouseover(() => {

            $('#receiver').css("background-color", "rgba(107, 72, 179, 0.45)");
        });
        $('#testest').mouseout(() => {

            $('#receiver').css("background-color", "rgba(147, 112, 219, 0.45)");
        });
        $('#testest2').mouseover(() => {

            $('#receiver2').css("background-color", "rgba(210, 210, 210, 0.45)");
        });
        $('#testest2').mouseout(() => {

            $('#receiver2').css("background-color", "rgba(250, 250, 250, 0.45)");
        });
    </script>
@endpush
