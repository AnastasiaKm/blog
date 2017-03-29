@extends('app')

@section('content')
  <h1>All Users</h1>

  @foreach ($all_users->chunk(4) as $userSet)
    <div class="row users">
      @foreach($userSet as $user)
        <div class="col-md-3 user-block">
          <a href="{{ route('all_users.show', $user->id) }}">
            <img class="media-object" src="/images/{{ $user->avatar }}"
                 alt="{{ $user->name }}"
                 width="70" height="70">
          </a>
          <h4 class="media-object">
            <a href="{{ route('all_users.show', $user->id ) }}">
              {{ $user->name }}
            </a>
          </h4>
        </div>
      @endforeach
    </div>
  @endforeach

  {{ $all_users->links() }}

@endsection
