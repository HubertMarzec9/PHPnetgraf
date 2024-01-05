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

<form method="POST" action="{{ route('findById') }}">
    @csrf
    <label for="id">ID:</label>
    <input type="text" name="id" id="id" value="{{ $pet['id'] ?? '2' }}" required>
    <button type="submit">Edit pet</button>
</form>

@if(isset($pet))
        <form method="POST" action="{{ route('update') }}">
            @csrf
            <input type="hidden" value="{{ $pet['id'] ?? '' }}" name="id" id="id" required><br>

            <label for="name">Name:</label>
            <input type="text" value="{{ $pet['name'] ?? '' }}" name="name" id="name" required><br>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="available" {{ isset($pet['status']) && $pet['status'] === 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ isset($pet['status']) && $pet['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ isset($pet['status']) && $pet['status'] === 'sold' ? 'selected' : '' }}>Sold</option>
            </select><br>

            <label for="categoryId">Category id:</label>
            <input type="text" name="categoryId" id="categoryId" value="{{ $pet['category']['id'] ?? '' }}" required><br>
            <label for="categoryName">Category name:</label>
            <input type="text" name="categoryName" id="categoryName" value="{{ $pet['category']['name'] ?? '' }}" required><br>

            <label for="photoUrls">Photo URLs:</label>
            <div id="photoUrlsContainer">
                @if(isset($pet['photoUrls']))
                    @foreach($pet['photoUrls'] as $index => $photoUrl)
                        <input type="text" name="photoUrls[{{ $index }}]" placeholder="photo Url" value="{{ $photoUrl }}" required>
                    @endforeach
                @endif
            </div>
            <button type="button" onclick="addPhotoUrl()">Add Photo URL</button>
            <br>

            <label for="tags">Tags:</label>
            <div id="tagsContainer">
                @if(isset($pet['tags']))
                    @foreach($pet['tags'] as $index => $tag)
                        <div class="tag">
                            <input type="text" name="tags[{{ $index }}][id]" placeholder="Tag ID" value="{{ $tag['id'] ?? '' }}" required>
                            <input type="text" name="tags[{{ $index }}][name]" placeholder="Tag Name" value="{{ $tag['name'] ?? '' }}" required>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" onclick="addTag()">Add Tag</button>
            <br>

            <button type="submit">Submit</button>
        </form>
@endif

<script>
    let tagCount = {{ isset($pet['tags']) ? count($pet['tags']) : 1 }};
    let photoUrlCount = {{ isset($pet['photoUrls']) ? count($pet['photoUrls']) : 1 }};

    function addPhotoUrl() {
        const container = document.getElementById('photoUrlsContainer');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = `photoUrls[${photoUrlCount}]`;
        input.placeholder = 'photo Url';
        container.appendChild(input);

        photoUrlCount++;
    }

    function addTag() {
        const container = document.getElementById('tagsContainer');
        const tagDiv = document.createElement('div');
        tagDiv.className = 'tag';

        const idInput = document.createElement('input');
        idInput.type = 'text';
        idInput.name = `tags[${tagCount}][id]`;
        idInput.placeholder = 'Tag ID';
        idInput.required = true;

        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = `tags[${tagCount}][name]`;
        nameInput.placeholder = 'Tag Name';
        nameInput.required = true;

        tagDiv.appendChild(idInput);
        tagDiv.appendChild(nameInput);

        container.appendChild(tagDiv);

        tagCount++;
    }


</script>

<a href="/">BACK</a><br>

</body>
</html>
