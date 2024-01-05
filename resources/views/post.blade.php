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


<h1>Add a new pet to the store</h1>
<form method="POST" action="{{ route('add') }}">
    @csrf
    <label for="id">Id:</label>
    <input type="text" value="1" name="id" id="id" required><br>

    <label for="name">Name:</label>
    <input type="text" value="doggie" name="name" id="name" required><br>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="available">Available</option>
        <option value="pending">Pending</option>
        <option value="sold">Sold</option>
    </select><br>

    <label for="categoryId">Category id:</label>
    <input type="text" name="categoryId" id="categoryId" value="0" required><br>
    <label for="categoryName">Category name:</label>
    <input type="text" name="categoryName" id="categoryName" value="string" required><br>

    <label for="photoUrls">Photo URLs:</label>
    <div id="photoUrlsContainer">
        <input type="text" name="photoUrls[]" placeholder="photo Url" value="string" required>
    </div>
    <button type="button" onclick="addPhotoUrl()">Add Photo URL</button>
    <br>

    <label for="tags">Tags:</label>
    <div id="tagsContainer">
        <div class="tag">
            <input type="text" name="tags[0][id]" placeholder="Tag ID" value="0" required>
            <input type="text" name="tags[0][name]" placeholder="Tag Name" value="string" required>
        </div>
    </div>
    <button type="button" onclick="addTag()">Add Tag</button>
    <br>

    <button type="submit">Submit</button>
</form>

<a href="/">BACK</a><br>

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

</body>
</html>
