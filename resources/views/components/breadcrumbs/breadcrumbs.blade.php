@php
    $segments = request()->segments();
    $url = url('/');
@endphp

<nav aria-label="breadcrumb" id="breadcrumb-container">
    <ol class="breadcrumb" id="breadcrumb-list">
        <li class="breadcrumb-item"><a href="{{ $url }}" class="breadcrumb-link" data-url="{{ $url }}">Home</a></li>
        @foreach($segments as $index => $segment)
            @php
                $url .= '/' . $segment;
            @endphp
            @if(request()->is('errors/404'))
                <li class="breadcrumb-item active" aria-current="page">404 Not Found</li>
                @break
            @elseif($index == count($segments) - 1)
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ $url }}" class="breadcrumb-link"  data-url="{{ $url }}">{{ ucfirst($segment) }}</a>
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $url }}" class="breadcrumb-link" data-url="{{ $url }}">{{ ucfirst($segment) }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
