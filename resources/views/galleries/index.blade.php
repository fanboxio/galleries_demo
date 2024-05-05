@extends('layouts.default')

@section('title', 'All Galleries')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($galleries as $gallery)
                <div class="col-md-3 mb-4">
                    @include('galleries.card', ['gallery' => $gallery])
                </div>
            @endforeach
            @if (count($galleries) === 0)
                <div class="text-center mt-4">
                    <h5>No galleries added yet.</h5>
                </div>
            @endif
        </div>
    </div>
@endsection