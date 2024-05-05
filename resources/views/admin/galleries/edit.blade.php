@extends('layouts.default')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Gallery</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('galleries.update', $gallery->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $gallery->name }}">
                            @error('name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="grid_size" class="form-label">Grid Size</label>
                            <input type="number" class="form-control" id="grid_size" name="grid_size" min="1" value="{{ $gallery->grid_size }}">
                            @error('grid_size')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $gallery->description }}</textarea>
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

                            <label class="form-label mt-3">Existing Gallery's Images</label>
                            <div class="row my-2">
                                @foreach ($gallery->getMedia('images') as $image)
                                    <div id="image-container-{{ $image->id }}" class="col-md-3 mb-3 text-center image-container">
                                        <img src="{{ $image->getUrl() }}" class="img-fluid" alt="Image">
                                        <span class="mt-3">{{ $image->file_name }}</span>
                                        <button
                                            type="submit"
                                            class="image-remove-button"
                                            onclick="deleteImage(event, {{ $image->id }})"
                                        >
                                            X
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select multiple class="form-select" id="tags" name="tags[]">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $gallery->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
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
                                    <option value="{{ $category->id }}" {{ in_array($category->id, $gallery->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
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

    @include('toast', ['toastMessage' => 'Image deleted successfully.'])

    @include('files')

    <script>
        const deleteImage = async (event, imageId) => {
            event.preventDefault();

            if (confirm('Are you sure you want to remove this image from the gallery (and from the system completely)?')) {
                const response = await fetch(`/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                });
                // If image is deleted successfully, remove it's container from the DOM and show toast message
                if (response.ok) {
                    // function from toast blade
                    loadToast();

                    document.getElementById(`image-container-${imageId}`).remove();
                } else {
                    console.error(`Failed to delete image with id ${imageId}`);
                }
            }
        }
    </script>
</div>

@endsection
