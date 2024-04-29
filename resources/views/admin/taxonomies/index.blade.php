@php
    $title = ucfirst($type);
    $taxonomies = match ($type) {
        'tags' => $tags,
        'categories' => $categories,
        default => [],
    };
@endphp

<div class="row">
    <div class="col">
    <h2>{{ $title }}</h2>
    </div>
    <div class="col text-end">
    <a href="{{ route($type . '.create') }}" class="btn btn-primary">Create</a>
    </div>
</div>
<table class="table mt-3">
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($taxonomies as $taxonomy)
        <tr>
            <td>{{ $taxonomy->name }}</td>
            <td>
                <a href="{{ route($type . '.edit', $taxonomy->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route($type . '.destroy', $taxonomy->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
