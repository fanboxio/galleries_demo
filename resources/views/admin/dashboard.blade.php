@extends('layouts.default')

@section('title', 'Admin Dashboard')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <div class="navbar-nav ml-auto">
        <span class="navbar-text mx-3">{{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="taxonomies-tab" data-bs-toggle="tab" data-bs-target="#taxonomies" type="button" role="tab" aria-controls="taxonomies" aria-selected="false">Taxonomies</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="galleries-tab" data-bs-toggle="tab" data-bs-target="#galleries" type="button" role="tab" aria-controls="galleries" aria-selected="false">Galleries</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
      @include('admin.users.index')
    </div>
    <div class="tab-pane fade" id="taxonomies" role="tabpanel" aria-labelledby="taxonomies-tab">
      <p>Taxonomies Content</p>
    </div>
    <div class="tab-pane fade" id="galleries" role="tabpanel" aria-labelledby="galleries-tab">
      <p>Galleries Content</p>
    </div>
  </div>
</div>
@endsection