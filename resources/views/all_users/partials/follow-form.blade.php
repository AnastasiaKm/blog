@if ($user->isFollowedBy(Auth::user()))
  {{ Form::open(['method' => 'DELETE', 'route' => ['follows.destroy', $user->id]]) }}
    {{ Form::hidden('userIdToUnfollow', $user->id) }}
    <button type="submit" class="btn btn-danger">Unfollow {{ $user->name }}</button>
  {{ Form::close() }}
@else
  {{ Form::open(['route' => 'follows.store']) }}
    {{ Form::hidden('userIdToFollow', $user->id) }}
    <button type="submit" class="btn btn-primary">Follow {{ $user->name }}</button>
  {{ Form::close() }}
@endif
