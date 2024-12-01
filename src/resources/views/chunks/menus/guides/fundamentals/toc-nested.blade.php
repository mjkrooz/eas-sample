<ul class="nav flex-column nav-pills {{ (($offset ?? 0) > 0) ? 'border-left' : '' }}" style="margin-left: {{ ($offset ?? 0) }}rem;">
    @foreach ($menu as $item)
    {{-- Skip if not string or array. --}}
    @if(!is_string($item) && !is_array($item))
        @continue
    @endif
    <li class="nav-item">
        {{-- String, good to go. --}}
        @if(is_string($item))
            <a class="nav-link rounded-0" href="#sec-{{ str_replace(' ', '-', strtolower($item)) }}">{{ $item }}</a>
        @endif
        {{-- Array, recursive. --}}
        @if(is_array($item))
            @include('sourceblock::chunks.menus.guides.fundamentals.toc-nested', ['menu' => $item, 'offset' => ($offset ?? 0) + 1])
        @endif
    </li>
    @endforeach
</ul>