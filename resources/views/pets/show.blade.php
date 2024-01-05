<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
</head>
<body>

@if(isset($pet))
    <p>ID: {{ $pet['id'] }}</p>
    <p>Name: {{ $pet['name'] }}</p>
    <p>Status: {{ $pet['status'] }}</p>

    <p>Photo Urls: </p>
    @if(isset($pet['photoUrls']))
        <div>
            [
            @foreach($pet['photoUrls'] as $photoUrl)
                <p>{{$photoUrl}}</p>
            @endforeach
            ]
        </div>
    @endif

    <p>Tags: </p>
    @if(isset($pet['tags']))
        <div>
            [
            @foreach($pet['tags'] as $tag)
                <p>{{$tag['id']}}</p>
                <p>{{$tag['name']}}</p>
            @endforeach
            ]
        </div>
    @endif

    <p>Category: </p>
    @if(isset($pet['category']))
        <div>
            [
            <p>ID: {{$pet['category']['id']}}</p>
            <p>Name: {{$pet['category']['name']}}</p>
            ]
        </div>
    @endif

@endif

<a href="{{ url()->previous() }}">BACK</a><br>
</body>
</html>
