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

<form method="POST" action="{{ route('findById') }}">
    @csrf
    <label for="id">ID:</label>
    <input type="text" name="id" id="id" value="1" required>
    <button type="submit">Find pet by ID</button>
</form>

<form method="POST" action="{{ route('findByStatus') }}">
    @csrf
    <label for="status">Status:</label>
    <input type="text" name="status" id="status" value="sold" required>
    <button type="submit">Finds pets by status</button>
</form>

<a href="/">BACK</a><br>

</body>
</html>




