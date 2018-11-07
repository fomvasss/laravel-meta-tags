@if(count($tags))
    @php
        $currentUrl = $path ? url($path) : \Illuminate\Support\Facades\Request::url();
    @endphp

    @foreach($available as $key => $option)
        @isset($tags[$key])
            @if($key === 'canonical'){{-- Canonical link --}}
                @if (! empty($tags[$key]) && url($tags[$key]) == $currentUrl && url($tags[$key]) != \Illuminate\Support\Facades\Request::fullUrl())
                    <link rel="canonical" href="{{ url($tags[$key]) }}"/>
                @endif
            @elseif($key === 'title'){{-- Title page --}}
                <title>{{ $tags[$key] ?? '' }}</title>
            @elseif($key === 'robots'){{-- Robots --}}
                <meta name="{{$key}}" content="{{ $tags[$key] ?: 'follow' }}" />
            @elseif (empty($option['type'])){{-- Description, keywords, ... --}}
                <meta name="{{$key}}" content="{{ $tags[$key] }}" />
            @elseif ($option['type'] == 'fb' && ! empty($tags[$key])){{-- FB ID tag --}}
                <meta property="fb:app_id" content="{{ $tags[$key] }}" />
            @elseif ($option['type'] == 'og'){{-- OG-tags --}}
                @if($key === 'og_url' && empty($tags[$key]))
                    <meta property="og:url" content="{{ $currentUrl }}" />
                @else
                    <meta property="{{str_replace_first('og_', 'og:', $key)}}" content="{{ $tags[$key] }}" />
                @endif
            @endif
        @endisset
    @endforeach
@else
    <title>{{ config('app.name') }}</title>
@endif