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

    <div class="container mt-5">
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

        <div class="row mb-3">
            <div class="col-md-6">
                <select class="form-select" id="tagFilter" aria-label="Filter by tag">
                    <option value="" selected>Filter by tag...</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="categoryFilter" aria-label="Filter by category">
                    <option value="" selected>Filter by category...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <button class="btn btn-primary" id="filterButton">Apply Filters</button>
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
                                        <img src="{{ $image->getUrl() }}" class="d-block w-100" alt="Gallery Image">
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
        </div>
    </div>

    <script>
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
            const tag = document.getElementById('tagFilter').value;
            const category = document.getElementById('categoryFilter').value;
            const { current_page: page } = {!! json_encode($galleries) !!};

            if (search) {
                url += '?search=' + search;
            }
            if (tag) {
                url += (search ? '&' : '?') + 'tag=' + tag;
            }
            if (category) {
                url += (search || tag ? '&' : '?') + 'category=' + category;
            }

            url += (search || tag || category ? '&' : '?') + 'page=' + page;

            window.location.href = url;
        };

        const filterButton = document.getElementById('filterButton');
        filterButton.addEventListener('click', applySearchFilterAndPagination);

    </script>
</div>
@endsection