<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body>

<form method="POST" action="{{ route('delete') }}">
    @csrf
    <label for="id">ID:</label>
    <input type="text" name="id" id="id" value="1" required>
    <button type="submit">Delete</button>
</form>

@if(isset($responseBody))
    <p><h1>Code: </h1> {{$responseBody['code']}} </p>
    @if($responseBody['code'] === 200)
        <p>Pet deleted</p>
    @endif
@endif

<a href="/">BACK</a><br>

</body>
</html>
