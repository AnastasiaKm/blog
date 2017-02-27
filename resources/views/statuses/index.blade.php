@extends('app')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">

    @include('partials.form-status')

    <div class="status-post">
      {{ Form::open() }}
        <div class="form-group">
          {{ Form::textarea('body', null, ['class' => 'form-control',
                                           'rows' => 3,
                                           'placeholder' => "What's on your mind?"]) }}
        </div>

        <div class="form-group status-post-submit">
          {{ Form:: submit('Post Status', ['class' => 'btn btn-default btn-xs']) }}
        </div>

      {{ Form::close() }}
    </div> <!-- status post -->

    @foreach($statuses as $status)
      <article class="media status-media">
        <div class="pull-left">
          <img class="media-object" src="/images/{{ $status->user->avatar }}"
               alt="{{ $status->user->name }}"
               width="50" height="50">
        </div>
        <div class="media-body">
          <h4 class="media-heading">{{ $status->user->name }}</h4>
          <p>{{ $status->created_at->diffForHumans() }}</p>
          {{ $status->body }}
      </article>
    @endforeach
  </div> <!-- col-md-6 -->
</div> <!-- row -->

{{ $statuses->links() }}

@endsection
