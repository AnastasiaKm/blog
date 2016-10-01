
@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-1">
    {{ $post->photo_id }}
    @if(isset($post->photo_id))
      {{-- <img src="{{ asset('images/' . $post->image) }}" class="img-responsive center-block"> --}}
      <img src="{{ $photo->file }}" class="img-responsive" style="width:300px; height:200px;">
    @endif
    <h1>{{ $post->title }}</h1>

    <p class="lead"> {!! $post->body !!} </p>
    <hr>

    <div class="tags">
      <span class="label label-info">Tags:</span><br>
      @foreach($post->tags as $tag)
        <span class="label label-default">{{ $tag->name }}</span>
      @endforeach
    </div> <!-- tags -->
    <div id="backend-comments" style="margin-top: 50px;">
      <h3 class="comments-title">
        <span class="glyphicon glyphicon-comment"></span>
        {{ $post->comments()->count() }} Comments
      </h3>

      {{-- <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Comment</th>
            <th>Created</th>
            <th width="70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($post->comments as $comment)
            <tr>
              <td>
                  <input class="form-control" type="text"
                  placeholder="{{ $comment->user_id }}"
                  value="{{ $comment->user->name }}"
                  readonly="">
              </td>
              <td>{{ $comment->comment }}</td>
              <td>{{ $comment->created_at ? $comment->created_at->diffForHumans() : "no date" }}</td>
              <td>
                <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-xs btn-primary">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href="{{ route('admin.comments.delete', $comment->id) }}" class="btn btn-xs btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> --}}
      @foreach($post->comments as $comment)
        <?php $avatar = $photos[$comment->id] ?>
        <div class="comment" style="margin-bottom: 45px;">
          <div class="author-info">
              <img src="/images/{{ $avatar }}"
              class="author-image" style="width: 50px;
              height: 50px; border-radius: 50%; float: left;">
              <div class="author-name" style="float: left;
              margin-left: 15px;">
              <p class="form-control-static" value="{{ $comment->user_id }}">{{ $comment->user->name }}</p>
              <p class="author-time" style="font-size: 11px;
              margin-top: -9px; font-style: italic; color: #aaa;">
                {{ $comment->created_at ? $comment->created_at->diffForHumans() : "no date" }}
              </p>
              </div> <!-- author-name -->
            </div> <!-- author-info -->
          <div class="comment-content" style="clear: both;
           font-size: 12px; line-height: 1.3em;">
            {{ $comment->comment }}
          </div> <!-- comment-content -->
          <br>
          <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-xs btn-primary">
            <span class="glyphicon glyphicon-pencil"></span>
          </a>
          <a href="{{ route('admin.comments.delete', $comment->id) }}" class="btn btn-xs btn-danger">
            <span class="glyphicon glyphicon-trash"></span>
          </a>

          <hr>
        </div> <!-- comment -->
    @endforeach

    </div> <!-- backend-comments -->
  </div> <!-- col -->

  <div class="col-md-4 col-md-offset-1">
    <div class="well">

      {{-- <dl class="dl-horizontal">
        <label>Url:</label>
        <p><a href=" {{ url('blog/' . $post->slug) }}">
                      {{ url('blog/' . $post->slug) }}</a></p>
      </dl> --}}

      <dl class="dl-horizontal">
        <label>Category:</label>
        <p>{{ $post->category->name }}</p>
      </dl>

      <dl class="dl-horizontal">
        <label>Created At:</label>
        <p>{{ date('M d, Y H:i', strtotime($post->created_at)) }}</p>
      </dl>

      <dl class="dl-horizontal">
        <label>Last Updated:</label>
        <p>{{ date('M d, Y H:i', strtotime($post->updated_at)) }}</p>
      </dl>

      <hr>

      <div class="row">
        <div class="col-sm-6">
          {!! Html::linkRoute('admin.posts.edit', 'Edit Post',
                    array($post->id),
                    array('class' => 'btn btn-primary btn-block')) !!}
        </div> <!-- col -->

        <div class="col-sm-6">
          {!! Form::open(['route' => ['admin.posts.destroy', $post->id],
                          'method' => 'DELETE']) !!}
          {!! Form::submit('Delete Post',
                          ['class' => 'btn btn-danger btn-block']) !!}
          {!! Form::close() !!}
        </div> <!-- col -->
      </div> <!-- row -->

      <div class="row">
        <div class="col-md-12">
          {{ Html::linkRoute('admin.posts.index', '<< See All Posts', [],
                            ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
        </div> <!-- col -->
      </div> <!-- row -->

    </div> <!-- well -->
  </div> <!-- col -->
</div> <!-- row -->
<br>
<br>
<br>

<div class="row">
  <div id="comment-form" class="col-md-5 col-md-offset-1">
    {{ Form::open(['route' => ['admin.comments.store', $post->id, $user->id],
                   'method' => 'POST']) }}
        {{-- {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }} --}}
        {{-- {{ Form::label('email', 'Email:') }}
        {{ Form::text('email', null, ['class' => 'form-control']) }} --}}
        {{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
        {{ Form::textarea('comment', null, [
                          'class' => 'form-control',
                          'rows'  => '5']) }}

        {{ Form::submit('Add Comment', [
                        'class' => 'btn btn-success btn-block']) }}

    {{ Form::close() }}
  </div> <!-- comment form -->
</div> <!-- row -->




@endsection
