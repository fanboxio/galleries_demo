@extends('layouts.default')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="tab-button nav-link {{ $tab === 'users' || !$tab ? 'active' : '' }}" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="tab-button nav-link {{ $tab === 'taxonomies' ? 'active' : '' }}" id="taxonomies-tab" data-bs-toggle="tab" data-bs-target="#taxonomies" type="button" role="tab" aria-controls="taxonomies" aria-selected="false">Taxonomies</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="tab-button nav-link {{ $tab === 'galleries' ? 'active' : '' }}" id="galleries-tab" data-bs-toggle="tab" data-bs-target="#galleries" type="button" role="tab" aria-controls="galleries" aria-selected="false">Galleries</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade {{ $tab === 'users' || !$tab ? 'show active' : '' }}" id="users" role="tabpanel" aria-labelledby="users-tab">
      @include('admin.users.index')
    </div>
    <div class="tab-pane fade {{ $tab === 'taxonomies' ? 'show active' : '' }}" id="taxonomies" role="tabpanel" aria-labelledby="taxonomies-tab">
      <div class="container mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.taxonomies.tags.index')
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.taxonomies.categories.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade {{ $tab === 'galleries' ? 'show active' : '' }}" id="galleries" role="tabpanel" aria-labelledby="galleries-tab">
      @include('admin.galleries.index')
    </div>
  </div>
</div>
@endsection