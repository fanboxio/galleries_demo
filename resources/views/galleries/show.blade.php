@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div id="carousel{{ $gallery->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($gallery->getMedia('images') as $key => $image)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                            <img src="{{ $image->getUrl() }}" class="d-block w-100" style="max-height: 55vh;" alt="Gallery Image">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $gallery->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $gallery->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="display-2">{{ $gallery->name }}</h1>
            
                <div class="d-flex">
                    @if (Auth::user()->hasLiked($gallery))
                        <button class="btn btn-primary me-2" disabled>Liked</button>
                    @else
                        <form action="{{ route('galleries.like', $gallery) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary me-2">Like</button>
                        </form>
                    @endif

                    @if (Auth::user()->hasDisliked($gallery))
                        <button class="btn btn-danger" disabled>Disliked</button>
                    @else
                        <form action="{{ route('galleries.dislike', $gallery) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Dislike</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 mb-4">
                    <h4>Description</h4>
                    <p>{{ $gallery->description }}</p>
                </div>

                <div class="col-md-6 mb-4">
                    <h4>Grid Size</h4>
                    <p>{{ $gallery->grid_size }}</p>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <h4>Tags</h4>
                    @foreach ($gallery->tags as $tag)
                        <a class="taxonomy-badge badge bg-success text-decoration-none" href="{{ route('tags.overview', ['slug' => $tag->slug ]) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>

                <div class="col-md-6 mb-4">
                    <h4>Categories</h4>
                    @foreach ($gallery->categories as $category)
                        <a class="taxonomy-badge badge bg-secondary text-decoration-none" href="{{ route('categories.overview', ['slug' => $category->slug ]) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
