<div class="container mt-3">
    <div class="row">
      <div class="col">
        <h2>Users</h2>
      </div>
      <div class="col text-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
      </div>
    </div>
    <table class="table mt-3">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Admin</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td class="align-middle">{{ $user->name }}</td>
            <td class="align-middle">{{ $user->email }}</td>
            <td class="align-middle">
              @if($user->admin)
                <span class="badge bg-primary">Yes</span>
              @else
                <span class="badge bg-secondary">No</span>
              @endif
            </td>
            <td>
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-light">Edit</a>
              <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>