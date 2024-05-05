@extends('layouts.default')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        @error('invalidCredentials')
                            <div class="mb-3 text-center text-danger">{{ $message }}</div>
                        @enderror
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" autofocus>
                            @error('email')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            If you don't have an account yet, you can create one
                            <a href="{{ route('register') }}">here</a>.
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection