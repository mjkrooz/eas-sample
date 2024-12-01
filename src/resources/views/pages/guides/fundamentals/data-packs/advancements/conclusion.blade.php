@extends('sourceblock::layouts.guides.fundamentals.advancements')

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Other resources'
    ]])
@endsection

@section('guide')
    {{-- CONCLUSION --}}

    {{-- OTHER RESOURCES --}}

    <h2 id="sec-other-resources">Other resources</h2>

    <ul class="list-group">
        <a class="list-group-item list-group-item-action text-primary" href="{{ route('tools:data-packs/advancement-evaluator') }}">Advancement evaluator</a>
        <a class="list-group-item list-group-item-action text-primary" href="https://misode.github.io/advancement/" target="_blank">Advancement generator by Misode</a>
        <a class="list-group-item list-group-item-action text-primary" href="https://advancements.thedestruc7i0n.ca/" target="_blank">Advancement generator by TheDestruc7i0n</a>
        <a class="list-group-item list-group-item-action text-primary" href="https://jsonlint.com/" target="_blank">Generic JSON validator</a>
    </ul>
@endsection