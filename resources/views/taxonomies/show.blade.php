@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <h1><i>{{ $taxonomy->name }}</i> {{ ucfirst($type) }} Overview</h1>

        <div class="row mt-5">
            @foreach($images as $image)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $image->getUrl() }}" class="card-img-top" style="max-height: 25vh;" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $image->name }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection