<footer class="mt-5" style="background-color: #EFEFEF;background-image:url('{{ image_asset('back_dark.png', 'primary') }}');background-size:cover !important;">
    <div style="background-color: rgba(25, 25, 25, 0.55);">
        <div class="container py-5">
            <div class="row">
                <div class="col-3">
                    <div class="list-group">
                        <a href="{{ route('home') }}"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.home') }}</a>
                        <a href="{{ route('home:about') }}"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.about') }}</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.contact') }}</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.community_guidelines') }}</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="list-group">
                        <a href="{{ route('databases:home') }}"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('databases::app/nav.main.title') }}</a>
                        <a href="{{ route('tools:home') }}"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('tools::app/nav.main.title') }}</a>
                        <a href="{{ route('guides:home') }}"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('guides::app/nav.main.title') }}</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">Community</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">Help</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">API</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="list-group">
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.news') }}</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.advertising') }}</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.terms') }}</a>
                        <a href="#!"
                           class="list-group-item list-group-item-action border-0 text-light bg-transparent">{{ trans('home::app/nav.footer.privacy') }}</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col-4">
                                    <img src="{{ image_asset('ext/2a7c6648-1afc-4c49-a8eb-11bd4dea962e.png', 'primary') }}" width="40" height="40" alt="Discord logo">
                                </div>
                                <div class="col-6"><a href="#!" target="_blank" class="ext-link text-light">{{ trans('home::app/nav.footer.discord') }}</a></div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <img src="{{ image_asset('ext/2228eae8-c564-4c95-9882-566ba81d0c7a.png', 'primary') }}" width="40" height="40" alt="Twitter logo">
                                </div>
                                <div class="col-6"><a href="#!" target="_blank" class="ext-link text-light">{{ trans('home::app/nav.footer.twitter') }}</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <a href="#!" class="text-secondary d-inline-block p-3" style="text-decoration: none !important;"><i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <i class="fab fa-creative-commons-sa fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
