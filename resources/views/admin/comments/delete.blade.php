@extends('layouts.admin')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h3>Are you sure you want to delete this comment??</h3>
      <p>
        <strong>Comment:</strong> {{ $comment->comment }}
      </p>

      {{ Form::open(['route' => ['admin.comments.destroy', $comment->id], 'method' => 'DELETE']) }}
        {{ Form::submit('yes, delete this comment',
                       ['class' => 'btn btn-lg btn-primary col-sm-6']) }}
        {{ Html::linkRoute('admin.posts.index', 'no, dont delete it', [],
                          ['class' => 'btn btn-lg btn-danger col-sm-6']) }}

      {{ Form::close() }}
    </div>
  </div>

@endsection
