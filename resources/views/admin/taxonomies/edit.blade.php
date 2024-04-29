@php
    $typePlural = match ($type) {
        'tag' => 'tags',
        'category' => 'categories',
        default => '',
    };
@endphp

@extends('layouts.default')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{ ucfirst($type) }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route($typePlural . '.update', $taxonomy->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Add form fields here -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $taxonomy->name }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
