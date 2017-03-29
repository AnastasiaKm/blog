<article class="comments__comment media status-media" style="	background: #e3e3e3;
	margin-top: 1em;
  margin-bottom: 0;
	border: 1px solid #a29f9f;
	border-bottom: 1px solid #e3e3e3;">

  <div class="pull-left">
    @include('partials.avatar', ['user' => $comment->user, 'class' => 'media-object'])
  </div>

  <div class="media-body">
    <h4 class="media-heading">{{ $comment->user->name}}</h4>

    {{ $comment->body }}
  </div>
</article>
