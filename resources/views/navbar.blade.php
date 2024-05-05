<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      @if (auth()->user())
        {{ auth()->user()->admin ? 'Admin' : 'Galleries' }} Dashboard
      @else
        Galleries App
      @endif
    </a>
    @if (auth()->user() && !auth()->user()->admin)
    <div class="navbar-nav me-auto">
      <a class="nav-link" href="{{ route('galleries') }}">All Galleries</a>
    </div>
    @endif
    <div class="navbar-nav ml-auto">
        @if (auth()->user())
          <span class="navbar-text me-3">{{ auth()->user()->name }}</span>
          @if (!auth()->user()->admin)
              <a class="nav-link me-3" href="{{ route('profile') }}">Profile</a>
          @endif
          <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-outline-primary me-3">Login</a>
          <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        @endif
    </div>
  </div>
</nav>