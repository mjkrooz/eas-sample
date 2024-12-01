@extends('sourceblock::layouts.primary.page_lead', [
    'subtitle' => trans('home::app/nav.footer.about'),
    'page_lead_title' => trans('home::app/main.title'),
    'page_lead_description' => trans('home::app/main.leads.about'),
    'page_lead_icon' => 'fas fa-signature'
])


@section('sub-content')
    <p>Source Block is a centralized location for Minecraft map makers and other content creators. It consists of databases filled with information relevant for creation, guides to make use of the information, and tools to generate or evaluate specific types of content.</p>

    <h3>Credits</h3>

    <p>Website design and development by Skylinerw. Content submission and upkeep is credited to the community.</p>
@endsection
