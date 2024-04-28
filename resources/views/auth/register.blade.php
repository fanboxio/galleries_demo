@extends('layouts.default')

@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-2">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="space-y-2">
            <button type="submit">Register</button>
        </div>
    </form>

@endsection
