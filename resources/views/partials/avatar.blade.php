<a href="{{ route('all_users.show', $user->id) }}">
  <img class="media-object" src="/images/{{ $user->avatar }}"
       alt="{{ $user->name }}"
       width="50" height="50">
</a>
