@extends('app')

@section('content')
  <div class="row">
    @include('partials.form-status')
    <div class="col-md-3">
      <h1>{{ $user->name }}</h1>
      <img class="media-object img-circle avatar" src="/images/{{ $user->avatar }}"
           alt="{{ $user->name }}"
           width="100" height="100">
    </div>
    <div class="col-md-6">
      @if (Auth::check() = $user->id)
        <div class="status-post">
          {{ Form::open(['route' => 'statuses.store']) }}
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
      @endif

      @if ($user->statuses->count())
        @foreach($user->statuses as $status)
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
      @else
        <p>This user hasn't yet posted a status</p>
      @endif
    </div>
  </div>

@endsection
