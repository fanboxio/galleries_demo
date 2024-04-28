@extends('layouts.default')

@section('title', 'Update User')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Update User - {{ $user->name }} ({{ $user->email }})</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}">
                            @error('name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="admin" class="form-label">Admin</label>
                            <select class="form-select" id="admin" name="admin">
                                <option value="1" {{ $user->admin ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$user->admin ? 'selected' : '' }}>No</option>
                            </select>
                            @error('admin')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
