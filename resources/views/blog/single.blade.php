@extends('main')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "| $titleTag")

@section('content')
<div class="container-fixed">
  <div class="row">
    <div class="col-md-4">
      <img src="/images/keep_calm.jpg"
        class="img-responsive center-block">
    </div>

    <div class="col-md-5 col-md-offset-2">
      @if(isset($post->image))
        <img src="{{ asset('images/' . $post->image) }}" class="img-responsive center-block">
      @endif
      <h1>{{ $post->title }}</h1>
      <p>{!! $post->body !!}</p>
      <hr>
      <p>Posted In: {{ $post->category->name }}</p>
    </div> <!-- col -->
  {{-- </div> <!-- row --> --}}

  {{-- <div class="row"> --}}
    <div class="col-md-5 col-md-offset-2">
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
  {{-- </div> <!-- row --> --}}

  <div class="row">
    <div id="comment-form" class="col-md-5 col-md-offset-6">
      {{ Form::open(['route' => ['comments.store', $post->id],
                     'method' => 'POST']) }}
      {{-- <div class="row"> --}}
        {{-- <div class="col-md-7 col-md-offset-5"> --}}
          {{ Form::label('name', 'Name:') }}
          {{ Form::text('name', null, ['class' => 'form-control']) }}
        {{-- </div> <!-- col --> --}}
        {{-- <div class="col-md-7 col-md-offset-5"> --}}
          {{ Form::label('email', 'Email:') }}
          {{ Form::text('email', null, ['class' => 'form-control']) }}
        {{-- </div> <!-- col --> --}}
        {{-- <div class="col-md-7 col-md-offset-5"> --}}
          {{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
          {{ Form::textarea('comment', null, [
                            'class' => 'form-control',
                            'rows'  => '5']) }}

          {{ Form::submit('Add Comment', [
                          'class' => 'btn btn-success btn-block']) }}
        {{-- </div> <!-- col --> --}}
      {{-- </div> <!-- row --> --}}

      {{ Form::close() }}

    </div> <!-- comment form -->
  </div> <!-- row -->
  </div> <!-- row -->
</div> <!-- container -->
@endsection
