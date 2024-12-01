<div class="shadow bg-info" style="background: url('{{ image_asset("back_dark.png") }}');background-size: cover;">
    @if(isset($feature_colord))
        {{-- TODO: figure out what to do with this. --}}
        <div class="shadow-sm" style="background-color: {{ $feature_color->getColorRgba() }};">
    @else
        <div class="shadow-sm" style="background-color: rgba(55, 55, 55, 0.5);">
    @endif
        <nav class="navbar navbar-expand-sm navbar-light d-none d-lg-block">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img src="{{ ("you_have_observed_correctly_that_there_is_no_logo.png") }}" height="50"
                        class="d-inline-block align-middle" alt="" style="line-height: 1.2;">
                    <span class="d-inline h4 align-middle mb-0 text-light">Source Block</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('databases:home') }}" class="nav-link text-light mr-4">Databases</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tools:home') }}" class="nav-link text-light mr-4">Tools</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guides:home') }}" class="nav-link text-light mr-4">Guides</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-light mr-4">Community</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-light mr-4">Help</a>
                    </li>

                    <li class="nav-item dropdown mr-4">
                        <a href="#!" class="nav-link dropdown-toggle text-warning" data-toggle="dropdown"><i
                                class="fas fa-user-lock"></i></a>

                        <div class="dropdown-menu">
                            <a href="#!" class="dropdown-item"><i class="fas fa-lock fa-sm"></i> Login</a>
                            <a href="#!" class="dropdown-item"><i class="fas fa-user fa-sm"></i> Register</a>
                        </div>
                    </li>

                    <li class="nav-item">

                        <select name="" id="" class="custom-select">
                            <option value="http://web.test/Working/source-block/alpha/public/de">Deutsch</option>
                            <option value="http://web.test/Working/source-block/alpha/public/en-US" selected>U.S.
                                English</option>
                            <option value="http://web.test/Working/source-block/alpha/public/es">español</option>
                            <option value="http://web.test/Working/source-block/alpha/public/fr">français</option>
                            <option value="http://web.test/Working/source-block/alpha/public/it">italiano</option>
                            <option value="http://web.test/Working/source-block/alpha/public/nl">Nederlands</option>
                            <option value="http://web.test/Working/source-block/alpha/public/pl">polski</option>
                            <option value="http://web.test/Working/source-block/alpha/public/pt">português</option>
                            <option value="http://web.test/Working/source-block/alpha/public/sv">svenska</option>
                            <option value="http://web.test/Working/source-block/alpha/public/vi">Tiếng Việt</option>
                            <option value="http://web.test/Working/source-block/alpha/public/tr">Türkçe</option>
                            <option value="http://web.test/Working/source-block/alpha/public/ru">русский</option>
                            <option value="http://web.test/Working/source-block/alpha/public/ja">日本語</option>
                            <option value="http://web.test/Working/source-block/alpha/public/zh">简体中文</option>
                            <option value="http://web.test/Working/source-block/alpha/public/ko">한국어</option>
                        </select>
                    </li>
                </ul>

            </div>
        </nav>
        <nav id="naaav" class="row rounded-0 d-block d-lg-none">
            <span class="offset-1"></span>
            <a href="#!" class="btn text-light p-3 col-2"><i class="fas fa-database fa-lg"></i></a>
            <a href="#!" class="btn text-light p-3 col-2"><i class="fas fa-tools fa-lg"></i></a>
            <a href="#!" class="btn text-light p-3 col-2"><i class="fas fa-book fa-lg"></i></a>
            <a href="#!" class="btn text-light p-3 col-2"><i class="fas fa-users fa-lg"></i></a>
            <a href="#!" class="btn text-light p-3 col-2"><i class="fas fa-hands-helping fa-lg"></i></a>
        </nav>
    </div>
    @include('chunks.content.primary.search-nav')
</div>
