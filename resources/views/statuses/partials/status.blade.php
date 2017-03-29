<article style="border: 1px solid #e3e3e3;
	border-bottom: none;
	background: white;
	padding: 1em;">
  <div class="pull-left">
    @include('partials.avatar', ['user' => $status->user, 'class' => 'status-media-object'])
  </div>

  <div class="media status-media-body">
    <h4 class="media status-media-heading">{{ $status->user->name }}</h4>
    <p>{{ $status->created_at->diffForHumans() }}</p>

    {{ $status->body }}
  </div>
</article>

{{ Form::open(['route' => ['stcomments.store', $status->id],
               'class' => 'comments__create-form',
               'style' => 'border: 1px solid #e3e3e3; border-top: none;
               	border-radius: 0;']) }}
  {{ Form::hidden('status_id', $status->id) }}

  <div class="form-group">
    {{ Form::textarea('body', null, ['class' => 'form-control',
                                     'rows' => 1,
                                     'placeholder' => "Add a comment..."]) }}
  </div>
{{ Form::close() }}

@unless ($status->comments->isEmpty())
  <div class="comments" style="margin-bottom: 5em; padding-left: 70px;">
    @foreach ($status->comments as $comment)
      @include ('statuses.partials.comment')
    @endforeach
  </div>
@endunless
