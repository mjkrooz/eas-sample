@extends('sourceblock::pages.guides.fundamentals.data-packs.advancements.trigger')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Target hit',
        [
            'Signal strength',
            'Projectile',
            'Shooter',
        ]
    ]])
@endsection