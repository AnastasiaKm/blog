
@extends('layouts.author')

@section('content')

<div class="row">
  <div class="col-md-5 col-md-offset-1">
    @if(isset($post->image))
      <img src="{{ asset('images/' . $post->image) }}" class="img-responsive center-block">
    @endif
    <h1>{{ $post->title }}</h1>

    <p class="lead"> {!! $post->body !!} </p>
    <hr>

    {{-- <div class="tags">
      @foreach($post->tags as $tag)
        <span class="label label-default">{{ $tag->name }}</span>
      @endforeach
    </div> <!-- tags --> --}}
    {{-- <div id="backend-comments" style="margin-top: 50px;">
      <h3>Comments<small> {{ $post->comments()->count() }} total</small> </h3>
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th width="70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($post->comments as $comment)
          <tr>
            <td>{{ $comment->name }}</td>
            <td>{{ $comment->email }}</td>
            <td>{{ $comment->comment }}</td>
            <td>
              <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary">
                <span class="glyphicon glyphicon-pencil"></span>
              </a>
              <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-trash"></span>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div> <!-- backend-comments --> --}}
  </div> <!-- col -->

  {{-- <div class="col-md-4 col-md-offset-1">
    <div class="well">

      <dl class="dl-horizontal">
        <label>Url:</label>
        <p><a href=" {{ url('blog/' . $post->slug) }}">
                      {{ url('blog/' . $post->slug) }}</a></p>
      </dl>

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
          {!! Html::linkRoute('posts.edit', 'Edit Post',
                    array($post->id),
                    array('class' => 'btn btn-primary btn-block')) !!}
        </div> <!-- col -->

        <div class="col-sm-6">
          {!! Form::open(['route' => ['posts.destroy', $post->id],
                          'method' => 'DELETE']) !!}
          {!! Form::submit('Delete Post',
                          ['class' => 'btn btn-danger btn-block']) !!}
          {!! Form::close() !!}
        </div> <!-- col -->
      </div> <!-- row -->

      <div class="row">
        <div class="col-md-12">
          {{ Html::linkRoute('posts.index', '<< See All Posts', [],
                            ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
        </div> <!-- col -->
      </div> <!-- row -->

    </div> <!-- well --> --}}
  {{-- </div> <!-- col --> --}}
</div> <!-- row -->

@endsection
