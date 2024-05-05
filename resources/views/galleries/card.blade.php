<div class="card">
    <div id="carousel{{ $gallery->id }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($gallery->getMedia('images') as $key => $image)
                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                    <img src="{{ $image->getUrl() }}" class="d-block w-100" style="max-height: 25vh;" alt="Gallery Image">
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
    <div class="card-body">
        <h5 class="card-title">{{ $gallery->name }}</h5>
        <p class="card-text">{{ $gallery->description }}</p>
        <a href="{{ route('galleries.show', $gallery->id) }}" class="btn btn-sm btn-primary">View Gallery</a>
    </div>
    <div class="card-footer">
        <div>
            Tags:
            @foreach($gallery->tags as $tag)
                <a class="taxonomy-badge badge bg-success text-decoration-none" href="{{ route('tags.overview', ['slug' => $tag->slug ]) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
        <div>
            Categories:
            @foreach($gallery->categories as $category)
                <a class="taxonomy-badge badge bg-secondary text-decoration-none" href="{{ route('categories.overview', ['slug' => $category->slug ]) }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</div>