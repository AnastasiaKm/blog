<article class="media status-media">
  <div class="pull-left">
    @include('partials.avatar', ['user' => $status->user])
  </div>

  <div class="media-body">
    <h4 class="media-heading">{{ $status->user->name }}</h4>
    <p>{{ $status->created_at->diffForHumans() }}</p>
    
    {{ $status->body }}
  </div>
</article>
