<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    @switch(Request::route()->getName())
        @case('tools:data-packs')
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-featured-tab" data-toggle="pill"
               href="#v-pills-featured" role="tab" aria-controls="v-pills-featured" aria-selected="true" data-tab-link="{{ route('tools:featured') }}"><i
                    class="fas fa-star text-warning mr-2"></i>Featured</a>
            <a class="nav-link py-3 rounded-0 text-dark active" id="v-pills-data-packs-tab" data-toggle="pill"
               href="#v-pills-data-packs" role="tab" aria-controls="v-pills-data-packs" aria-selected="false" data-tab-link="{{ route('tools:data-packs') }}">Data
                packs</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-resource-packs-tab" data-toggle="pill"
               href="#v-pills-resource-packs" role="tab" aria-controls="v-pills-resource-packs"
               aria-selected="false" data-tab-link="{{ route('tools:resource-packs') }}">Resource packs</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-other-tab" data-toggle="pill" href="#v-pills-other"
               role="tab" aria-controls="v-pills-other" aria-selected="false" data-tab-link="{{ route('tools:other') }}">Other</a>
        @break
        @case('tools:resource-packs')
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-featured-tab" data-toggle="pill"
               href="#v-pills-featured" role="tab" aria-controls="v-pills-featured" aria-selected="true" data-tab-link="{{ route('tools:featured') }}"><i
                    class="fas fa-star text-warning mr-2"></i>Featured</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-data-packs-tab" data-toggle="pill"
               href="#v-pills-data-packs" role="tab" aria-controls="v-pills-data-packs" aria-selected="false" data-tab-link="{{ route('tools:data-packs') }}">Data
                packs</a>
            <a class="nav-link py-3 rounded-0 text-dark active" id="v-pills-resource-packs-tab" data-toggle="pill"
               href="#v-pills-resource-packs" role="tab" aria-controls="v-pills-resource-packs"
               aria-selected="false" data-tab-link="{{ route('tools:resource-packs') }}">Resource packs</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-other-tab" data-toggle="pill" href="#v-pills-other"
               role="tab" aria-controls="v-pills-other" aria-selected="false" data-tab-link="{{ route('tools:other') }}">Other</a>
        @break
        @case('tools:other')
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-featured-tab" data-toggle="pill"
               href="#v-pills-featured" role="tab" aria-controls="v-pills-featured" aria-selected="true" data-tab-link="{{ route('tools:featured') }}"><i
                    class="fas fa-star text-warning mr-2"></i>Featured</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-data-packs-tab" data-toggle="pill"
               href="#v-pills-data-packs" role="tab" aria-controls="v-pills-data-packs" aria-selected="false" data-tab-link="{{ route('tools:data-packs') }}">Data
                packs</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-resource-packs-tab" data-toggle="pill"
               href="#v-pills-resource-packs" role="tab" aria-controls="v-pills-resource-packs"
               aria-selected="false" data-tab-link="{{ route('tools:resource-packs') }}">Resource packs</a>
            <a class="nav-link py-3 rounded-0 text-dark active" id="v-pills-other-tab" data-toggle="pill" href="#v-pills-other"
               role="tab" aria-controls="v-pills-other" aria-selected="false" data-tab-link="{{ route('tools:other') }}">Other</a>
        @break
        @default
            <a class="nav-link py-3 rounded-0 text-dark active" id="v-pills-featured-tab" data-toggle="pill"
               href="#v-pills-featured" role="tab" aria-controls="v-pills-featured" aria-selected="true" data-tab-link="{{ route('tools:featured') }}"><i
                    class="fas fa-star text-warning mr-2"></i>Featured</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-data-packs-tab" data-toggle="pill"
               href="#v-pills-data-packs" role="tab" aria-controls="v-pills-data-packs" aria-selected="false" data-tab-link="{{ route('tools:data-packs') }}">Data
                packs</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-resource-packs-tab" data-toggle="pill"
               href="#v-pills-resource-packs" role="tab" aria-controls="v-pills-resource-packs"
               aria-selected="false" data-tab-link="{{ route('tools:resource-packs') }}">Resource packs</a>
            <a class="nav-link py-3 rounded-0 text-dark" id="v-pills-other-tab" data-toggle="pill" href="#v-pills-other"
               role="tab" aria-controls="v-pills-other" aria-selected="false" data-tab-link="{{ route('tools:other') }}">Other</a>
    @endswitch
</div>
