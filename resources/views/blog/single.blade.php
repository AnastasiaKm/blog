@extends('main')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "| $titleTag")

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      @if(isset($post->image))
        <img src="{{ asset('images/' . $post->image) }}" height="400" width="800">
      @endif
      <h1>{{ $post->title }}</h1>
      <p>{!! $post->body !!}</p>
      <hr>
      <p>Posted In: {{ $post->category->name }}</p>
    </div> <!-- col -->
  </div> <!-- row -->

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h3 class="comments-title">
        <span class="glyphicon glyphicon-comment"></span>
        {{ $post->comments()->count() }} Comments
      </h3>
      @foreach($post->comments as $comment)
        <div class="comment">
          <div class="author-info">
            <img src="{{ "https://www.gravatar.com/avatar/"
              . md5(strtolower(trim($comment->email)))
              . "?s=50&d=retro"}}"
            class="author-image">
            <div class="author-name">
              <h4>{{ $comment->name }}</h4>
              <p class="author-time">
                {{ date('F nS, Y - g:iA', strtotime($comment->created_at)) }}
              </p>
            </div> <!-- author-name -->
          </div> <!-- author-info -->
          <div class="comment-content">
            {{ $comment->comment }}
          </div> <!-- comment-content -->
          <hr>
        </div> <!-- comment -->
      @endforeach
    </div> <!-- col -->
  </div> <!-- row -->

  <div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
      {{ Form::open(['route' => ['comments.store', $post->id],
                     'method' => 'POST']) }}
      <div class="row">
        <div class="col-md-6">
          {{ Form::label('name', 'Name:') }}
          {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div> <!-- col -->
        <div class="col-md-6">
          {{ Form::label('email', 'Email:') }}
          {{ Form::text('email', null, ['class' => 'form-control']) }}
        </div> <!-- col -->
        <div class="col-md-12">
          {{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
          {{ Form::textarea('comment', null, [
                            'class' => 'form-control',
                            'rows'  => '5']) }}

          {{ Form::submit('Add Comment', [
                          'class' => 'btn btn-success btn-block']) }}
        </div> <!-- col -->
      </div> <!-- row -->

      {{ Form::close() }}

    </div> <!-- comment form -->
  </div> <!-- row -->
@endsection
