@extends('sourceblock::layouts.primary')

@section('content')
    <!-- PRIMARY CONTENT -->
            <div class="row mt-5 pt-5 mb-4">
                <div class="col-12 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-database display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="{{ route('databases:home') }}" class="text-dark">{{ trans('databases::app/nav.main.title') }}</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.databases') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-tools display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="{{ route('tools:home') }}" class="text-dark">{{ trans('tools::app/nav.main.title') }}</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.tools') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-book display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="{{ route('guides:home') }}" class="text-dark">{{ trans('guides::app/nav.main.title') }}</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.guides') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-users display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="#!" class="text-dark">Community</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.community') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-hands-helping display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="#!" class="text-dark">Help</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.help') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fab fa-searchengin display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="#!" class="text-dark">Search</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.search') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-hat-wizard display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="#!" class="text-dark">API</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.api') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="fas fa-chalkboard-teacher display-4 text-info"></i>
                        </div>
                        <div class="col-9">
                            <h3 class="font-weight-bold"><a href="#!" class="text-dark">Contributions</a></h3>
                            <p class="lead">{{ trans('home::app/main.leads.contributions') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="jumbotron jumbotron-fluid bg-dark text-light mb-0">

            <div class="container">
                <div class="row">
                    <div class="col-6 p-4">

                        <h3>Edition</h3>

                        <p>Select the default <a href="#!" class="text-warning">edition</a> to view the site with.</p>

                        <select name="" id="" class="custom-select">
                            <option value="">Minecraft: Java Edition</option>
                            <option value="">Minecraft: Bedrock Edition</option>
                        </select>
                    </div>
                    <div class="col-6 p-4">
                        <h3>Version</h3>

                        <p>Select the version to view the site with based on the selected edition.</p>

                        <select name="" id="" class="custom-select">
                            <option value="">Latest stable version</option>
                            <option value="">Latest development version</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="row">
                <div class="col pt-5">
                    <h3 class="border-bottom">{{ trans('home::app/main.news.latest_news') }}</h3>

                    <div class="mt-4">
                        <div class="row align-items-center">
                            <div class="col-1 text-right">
                                <i class="fas fa-wrench h2 text-success"></i>
                            </div>
                            <div class="col-11">
                                <h5><a href="#!">Advancement Evaluator</a> <span
                                        class="badge badge-success text-uppercase">new</span></h5>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti maxime
                                    eum quae sint libero enim esse natus aut ut suscipit voluptas in laborum nisi labore
                                    ipsa, at laboriosam odit repudiandae, eveniet, a aliquid. Sint!</p>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-1 text-right">
                                <i class="fas fa-code-branch h2 text-danger"></i>
                            </div>
                            <div class="col-11">
                                <h5><a href="#!">Release 1.4</a> <span class="badge badge-info">Minecraft: Java
                                        Edition</span></h5>
                                <p class="m-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum quaerat
                                    praesentium modi esse excepturi quo!</p>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-1 text-right">
                                <i class="fas fa-wrench h2 text-success"></i>
                            </div>
                            <div class="col-11">
                                <h5><a href="#!">Text Component Evaluator</a> <span
                                        class="badge badge-success text-uppercase">new</span></h5>
                                <p class="m-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque,
                                    molestiae repellendus similique saepe provident dolor neque minus accusantium veniam
                                    ipsa aspernatur quia mollitia aut pariatur dignissimos repellat id nemo voluptatibus
                                    labore dolorum quaerat fugit repudiandae reiciendis consequuntur! Sequi, fugit
                                    fugiat, vitae error aut nihil neque, commodi maxime iste minima dolore?</p>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-1 text-right">
                                <i class="fas fa-wrench h2 text-success"></i>
                            </div>
                            <div class="col-11">
                                <h5><a href="#!">Lorem Ipsum Dolor</a></h5>
                                <p class="m-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, minus
                                    earum voluptatibus dolor ipsam fugit eveniet odio! Molestiae odit ipsam voluptatibus
                                    repellat iure?</p>
                            </div>
                        </div>

                        <a href="#!" class="btn btn-block btn-outline-success btn-lg mt-4">{{ trans('home::app/main.news.read_all') }}</a>
                    </div>
                </div>
            </div>
@endsection
