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

@if(isset($pets))
    @foreach($pets as $pet)
        @if(isset($pet['id']))
        <p><h1>ID:</h1> {{ $pet['id'] }}</p>
        @endif

        @if(isset($pet['name']))
        <p><h1>Name:</h1> {{ $pet['name'] }}</p>
        @endif

        @if(isset($pet['status']))
        <p><h1>Status:</h1> {{ $pet['status'] }}</p>
        @endif

        @if(isset($pet['photoUrls']))
            <p><h1>Photo Urls:</h1> </p>
            <div>
                [
                @foreach($pet['photoUrls'] as $photoUrl)
                    <p>{{$photoUrl}}</p>
                @endforeach
                ]
            </div>
        @endif

        @if(isset($pet['tags']))
            <p><h1>Tags:</h1> </p>
            <div>
                [
                @foreach($pet['tags'] as $tag)
                    <p>{{$tag['id']}}</p>
                    <p>{{$tag['name']}}</p>
                @endforeach
                ]
            </div>
        @endif

        @if(isset($pet['category']))
            <p><h1>Category:</h1> </p>
            <div>
                [
                <p>ID: {{$pet['category']['id']}}</p>
                <p>Name: {{$pet['category']['name']}}</p>
                ]
            </div>
        @endif
        <br><hr style="margin: 0;border: none;border-top: 5px solid #ccc;"><br>
    @endforeach
@endif

<a href="/">BACK</a><br>
</body>
</html>
