@extends('layouts.default')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-2">My Profile</h3>
                </div>

                <div class="card-body">
                    <p><i>Name</i>: {{ Auth::user()->name }}</p>
                    <p><i>Email</i>: {{ Auth::user()->email }}</p>

                    <h5 class="mt-4">Favourite Galleries</h5>
                    <ul>
                        @forelse (Auth::user()->likedGalleries as $gallery)
                            <li><a href="{{ route('galleries.show', $gallery) }}">{{ $gallery->name }}</a></li>
                        @empty
                            No favourite galleries yet.
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
