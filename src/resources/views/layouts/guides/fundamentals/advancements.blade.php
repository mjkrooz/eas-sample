@extends('sourceblock::layouts.guides.fundamentals.guide', ['content_banner_title' => trans('sourceblock::App/titles.minecraft.advancements'), 'content_banner_lead' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus laborum vero totam.', 'content_banner_icon_class' => 'fas fa-trophy'])

@section('guide-navigation-tabs')
    @include('sourceblock::chunks.menus.guides.fundamentals.tabs', ['menu' => [
        'guides:fundamentals/data-packs/advancements',
        'guides:fundamentals/data-packs/advancements/customization',
        'guides:fundamentals/data-packs/advancements/triggers',
        'guides:fundamentals/data-packs/advancements/conclusion'
    ]])
@endsection

{{--@push('after-guide')

<div class="jumbotron jumbotron-fluid mt-5 p-0 bg-success text-light">

    <a href="{{ route('tools:data-packs/advancement-evaluator') }}" class="btn btn-lg w-100 py-5 btn-success d-flex justify-content-center align-items-center"><i class="far fa-chart-bar fa-3x float-left"></i><span class="text-align-center w-100 h1" style="font-weight:lighter !important;">Evaluate custom advancements</span></a>
</div>
@endpush--}}
