@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
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
                                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                                        <a href="{{ route('tags.overview', ['slug' => $tag->slug ]) }}">{{ $tag->name }}</a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <h5>Categories</h5>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="category" value="{{ $category->id }}" id="category-{{ $category->id }}">
                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                        <a href="{{ route('categories.overview', ['slug' => $category->slug ]) }}">{{ $category->name }}</a>
                                    </label>
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
                            @include('galleries.card', ['gallery' => $gallery])
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