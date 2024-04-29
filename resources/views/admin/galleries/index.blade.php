<div class="container mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h2>List of all galleries</h2>
                </div>
                <div class="col text-end">
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary mb-3">Create</a>
                </div>
                </div>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Grid Size</th>
                        <th>Description</th>
                        <th>Creator</th>
                        <th>Tags</th>
                        <th>Categories</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery)
                    <tr>
                        <td>{{ $gallery->name }}</td>
                        <td>{{ $gallery->grid_size }}</td>
                        <td>{{ $gallery->description }}</td>
                        <td>{{ $gallery->creator->name }}</td>
                        <td>
                            <ul>
                                @foreach ($gallery->tags as $tag)
                                    <li>{{ $tag->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach ($gallery->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this gallery?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
