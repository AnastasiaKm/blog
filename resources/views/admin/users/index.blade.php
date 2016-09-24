@extends('layouts.admin')

@section('content')

  @if(Session::has('success'))
    <p class="bg-danger">{{ session('success') }}</p>
  @endif

  <h1>Users</h1>

  <table class="table">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    <tbody>
      @if($users)
        @foreach($users as $user)
          <tr>
            <td><img height="50" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" /></td>
            <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td>{{ $user->is_active == 1 ? 'Active' : 'Not Active' }}</td>
            <td>{{ $user->created_at ? $user->created_at->diffForHumans() : "no date" }}</td>
            <td>{{ $user->updated_at ? $user->updated_at->diffForHumans() : "no date" }}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
  <div class="text-center">
    {!! $users->links(); !!}
  </div> <!-- text center -->


@endsection
