@extends('layouts.default')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Gallery</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="grid_size" class="form-label">Grid Size</label>
                            <input type="number" class="form-control" id="grid_size" name="grid_size" min="1">
                            @error('grid_size')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            @error('description')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload multiple images -->
                        <div class="mb-3">
                            <label for="images" class="form-label">Upload Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept=".jpg,.jpeg,.png">
                            
                            <!-- Uploaded images preview -->
                            <label class="form-label mt-3">Uploaded Images</label>
                            <div class="row my-2" id="imagesPreviewContainer">
                                <i class="mx-2">No Uploaded images yet.</i>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select multiple class="form-select" id="tags" name="tags[]">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories</label>
                            <select multiple class="form-select" id="categories" name="categories[]">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('files')
</div>

@endsection
