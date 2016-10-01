@extends('layouts.author')
@section('content')
  <div class="container">
      <div class="row">
            @if(Session::has('success'))
              <p class="bg-danger">{{ session('success') }}</p>
            @endif
            <div class="col-sm-3">
              <img class="img-responsive img-rounded"
              src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" />
            </div>

            <div class="col-md-7 col-md-offset-1">
              <h2>{{ $user->name }}'s Profile</h2>
              <h4>Email: {{ $user->email }}</h4>
              <h4>Role: {{ $user->role->name }}</h4>
              <h4>Active: {{ $user->is_active == 1 ? 'Active' : 'Not Active' }}</h4>
            </div>
        </div>
    </div>


@endsection
