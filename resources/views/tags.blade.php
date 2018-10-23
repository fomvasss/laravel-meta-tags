@if(!empty($tags))
@foreach($available as $key => $option)
@if(!empty($tags[$key]))
@if($key == 'title')
<title>{{ $tags[$key] ?? '' }}</title>
@elseif (empty($option['type']))
<meta name="{{$key}}" content="{{ $tags[$key] }}">
@elseif ($option['type'] == 'og')
<meta property="{{str_replace_first('og_', 'og:', $key)}}" content="{{ $tags[$key] }}" />
@endif
@endif
@endforeach
@else
<title>{{ config('app.name') }}</title>
@endif