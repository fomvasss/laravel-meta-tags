@if(count($tags))
    @php
        $currentUrl = $path ? url($path) : \Illuminate\Support\Facades\Request::url();
    @endphp

    @foreach($config['available'] ?? [] as $key => $option)
        @if (isset($tags[$key]) && !in_array($key, ['h1']))
            @if($key === 'canonical'){{-- Canonical link --}}
                @if (! empty($tags[$key]) /*&& url($tags[$key]) == $currentUrl && url($tags[$key]) != \Illuminate\Support\Facades\Request::fullUrl()*/)
                    <link rel="canonical" href="{{ url($tags[$key]) }}"/>
                @endif
            @elseif($key === 'title'){{-- Title page --}}
                <title>{{ $tags[$key] ?? '' }}</title>
            @elseif (in_array($key, ['description', 'keywords']))
                <meta name="{{$key}}" content="{{ $tags[$key] }}" />
            @elseif($key === 'robots'){{-- Robots --}}
                <meta name="{{$key}}" content="{{ $tags[$key] ?: 'follow' }}" />
            @elseif ($key == 'fb_app_id'/* && ! empty($tags[$key])*/){{-- FB ID tag --}}
                <meta property="fb:app_id" content="{{ $tags[$key] ?? $config['default']['fb_app_id'] ?? '' }}" />
            @elseif ($option['type'] == 'og'){{-- OG-tags --}}
                @if($key === 'og_url')
                    <meta property="og:url" content="{{ $tags[$key] ? url($tags[$key]) : $currentUrl }}" />
                @elseif($key === 'og_image' && ! empty($tags[$key]))
                    <meta property="og:image" content="{{ url($tags[$key]) }}" />
                    <meta property="og:image:type" content="{{ $tags['og_image_type'] ?? $config['default']['og_image']['type'] ?? 'image/png' }}">
                    <meta property="og:image:width" content="{{ $tags['og_image_width'] ?? $config['default']['og_image']['width'] ?? 780 }}">
                    <meta property="og:image:height" content="{{ $tags['og_image_height'] ?? $config['default']['og_image']['height'] ?? 780 }}">
                @else
                    <meta property="{{str_replace_first('og_', 'og:', $key)}}" content="{{ $tags[$key] }}" />
                @endif
            @endif
        @endif
    @endforeach
@else
    <title>{{ config('app.name') }}</title>
@endif