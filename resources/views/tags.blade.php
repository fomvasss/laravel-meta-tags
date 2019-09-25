@if(count($tags))
    @foreach(config('meta-tags.available') as $key => $option)
        @if (isset($tags[$key]))
            @if($key === 'canonical' && $tags[$key])
                <link rel="canonical" href="{{ url($tags[$key]) }}"/>
            @elseif($key === 'title')
                <title>{{ $tags[$key] }}</title>
            @elseif($key === 'description')
                <meta name="description" content="{{ $tags[$key] }}"/>
            @elseif($key === 'keywords')
                <meta name="keywords" content="{{ $tags[$key] }}"/>
            @elseif($key === 'robots')
                <meta name="robots" content="{{ $tags[$key] }}"/>
            @elseif ($key == 'fb_app_id')
                <meta property="fb:app_id" content="{{ $tags[$key] ?: config('meta-tags.default.fb_app_id', '') }}"/>
            @elseif (preg_match('/^og_\w+/', $key))
                @if($key === 'og_url')
                    <meta property="og:url" content="{{ url($tags[$key] ?: $path) }}"/>
                @elseif($key === 'og_image' && !empty($tags[$key]))
                    <meta property="og:image" content="{{ url($tags[$key]) }}"/>
                    <meta property="og:image:type" content="{{ $tags['og_image_type'] ?? config('meta-tags.default.og_image.type', 'image/png') }}">
                    <meta property="og:image:width" content="{{ $tags['og_image_width'] ?? config('meta-tags.default.og_image.width', 780) }}">
                    <meta property="og:image:height" content="{{ $tags['og_image_height'] ?? config('meta-tags.default.og_image.height', 780) }}">
                @else
                    <meta property="{{ \Illuminate\Support\Str::replaceFirst('og_', 'og:', $key)}}" content="{{ $tags[$key] }}"/>
                @endif
            @endif
        @endif
    @endforeach
@else
    <title>{{ config('app.name') }}</title>
@endif