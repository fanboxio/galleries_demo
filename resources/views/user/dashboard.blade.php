@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Galleries Dashboard</a>
        <div class="navbar-nav ml-auto">
            <span class="navbar-text mx-3">{{ auth()->user()->name }}</span>
            <a class="nav-link mx-3" href="{{ route('profile') }}">Profile</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>
    </nav>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-2">
                <div class="d-flex align-items-center flex-column">
                    <div class="mb-2">
                        <div class="mb-3">
                            <h5>Tags</h5>
                            @foreach($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tag" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                                    <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <h5>Categories</h5>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="category" value="{{ $category->id }}" id="category-{{ $category->id }}">
                                    <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-primary" id="filterButton">Apply Filters</button>
                </div>
            </div>

            <div class="col-md-10">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input
                            type="text"
                            class="form-control"
                            id="searchInput"
                            oninput="handleSearchInput()"
                            onfocus="moveCaretToEnd()"
                            placeholder="Search galleries by name..."
                            value="{{ request('search') }}"
                            autofocus
                        >
                    </div>
                </div>

                {{ $galleries->appends(request()->except('page'))->links() }}

                <div class="row">
                    @foreach($galleries as $gallery)
                        <div class="col-md-3 mb-4">
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
                                            <span class="badge bg-success">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <div>
                                        Categories:
                                        @foreach($gallery->categories as $category)
                                            <span class="badge bg-secondary">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="noGalleriesMessage" class="d-{{ count($galleries) === 0 ? 'block' : 'none' }} text-center mt-4">
                        <h5>No galleries found. Please try adjusting your search/filters.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // SEARCH

        let timeoutId;

        // Search with debouncing - trigger search 500ms after user's last input
        const handleSearchInput = () => {
            if (timeoutId) {
                clearTimeout(timeoutId);
            }
            timeoutId = setTimeout(applySearchFilterAndPagination, 500);
        };

        const moveCaretToEnd = () => {
            const searchInput = document.getElementById('searchInput');
            const length = searchInput.value.length;
            searchInput.setSelectionRange(length, length);
        }

        const applySearchFilterAndPagination = () => {
            let url = window.location.href.split('?')[0];
            const search = document.getElementById('searchInput').value;
            const { current_page: page } = {!! json_encode($galleries) !!};

            if (search) {
                url += '?search=' + search;
            }

            if (selectedTags.length) {
                url += (search ? '&' : '?') + 'tags[]=' + selectedTags.join('&tags[]=');
            }

            if (selectedCategories.length) {
                url += (search || selectedTags.length ? '&' : '?') + 'categories[]=' + selectedCategories.join('&categories[]=');
            }

            url += (search || selectedTags.length || selectedCategories.length ? '&' : '?') + 'page=' + page;

            window.location.href = url;
        };

        // FILTERING

        let selectedTags = {!! json_encode(request()->get('tags') ?? []) !!};
        let selectedCategories = {!! json_encode(request()->get('categories') ?? []) !!};

        // Change event listeners for all tags and categories checkboxes
        document.querySelectorAll('input[name="tag"]').forEach(tagCheckbox => {
            tagCheckbox.checked = selectedTags.includes(tagCheckbox.value);
            tagCheckbox.addEventListener('change', (event) => updateSelectedTags(event.target.value, event.target.checked));
        });
        document.querySelectorAll('input[name="category"]').forEach(categoryCheckbox => {
            categoryCheckbox.checked = selectedCategories.includes(categoryCheckbox.value);
            categoryCheckbox.addEventListener('change', (event) => updateSelectedCategories(event.target.value, event.target.checked));
        });

        const filterButton = document.getElementById('filterButton');
        filterButton.addEventListener('click', applySearchFilterAndPagination);

        const updateSelectedTags = (tagId, isChecked) =>
            isChecked
                ? selectedTags.push(tagId)
                : selectedTags = selectedTags.filter(id => id !== tagId);

        const updateSelectedCategories = (categoryId, isChecked) =>
            isChecked
                ? selectedCategories.push(categoryId)
                : selectedCategories = selectedCategories.filter(id => id !== categoryId);

    </script>
</div>
@endsection