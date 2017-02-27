@extends('app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h3>Are you sure you want to delete this post??</h3>
      <p>
        <strong>Post:</strong> {!! $post->post !!}
      </p>

      {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
        {{ Form::submit('yes, delete this post',
                       ['class' => 'btn btn-lg btn-primary col-sm-6']) }}
        {{ Html::linkRoute('posts.index', 'no, dont delete it', [],
                          ['class' => 'btn btn-lg btn-danger col-sm-6']) }}

      {{ Form::close() }}
    </div>
  </div>

@endsection
