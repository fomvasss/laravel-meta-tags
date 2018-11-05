@if(count($tags))
    @foreach($available as $key => $option)
        @isset($tags[$key])
            @if($key === 'canonical'){{-- Canonical link --}}
                @if (! empty($tags[$key]) && url($tags[$key]) == \Illuminate\Support\Facades\Request::url() && url($tags[$key]) != \Illuminate\Support\Facades\Request::fullUrl())
                    <link rel="canonical" href="{{ url($tags[$key]) }}"/>
                @endif
            @elseif($key === 'title'){{-- Title page --}}
                <title>{{ $tags[$key] ?? '' }}</title>
            @elseif (empty($option['type'])){{-- Description, keywords, ... --}}
                <meta name="{{$key}}" content="{{ $tags[$key] }} /">
            @elseif ($option['type'] == 'og'){{-- OG-tags --}}
                @if($key === 'og_url' && empty($tags[$key]))
                    <meta property="og:url" content="{{ \Illuminate\Support\Facades\Request::url() }}" />
                @else
                    <meta property="{{str_replace_first('og_', 'og:', $key)}}" content="{{ $tags[$key] }}"/>
                @endif
            @endif
        @endisset
    @endforeach
@else
    <title>{{ config('app.name') }}</title>
@endif