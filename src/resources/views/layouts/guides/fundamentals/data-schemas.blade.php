@extends('sourceblock::layouts.guides.fundamentals.guide', ['content_banner_title' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.title'), 'content_banner_lead' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus laborum vero totam.', 'content_banner_icon_class' => 'fas fa-code'])

@section('guide-navigation-tabs')
    @include('sourceblock::chunks.menus.guides.fundamentals.tabs', ['menu' => [
        'guides:fundamentals/data-packs/data-schemas',
        'guides:fundamentals/data-packs/data-schemas/schemas'
    ]])
@endsection
