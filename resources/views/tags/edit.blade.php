@extends('main')

@section('title', '| Edit A Tag')

@section('content')

  <div class="row">
    <div class="col-md-4 col-md-offset-1">
      <h1>Edit The Tag</h1>
      <hr>


      {!! Form::model($tag, ['route' => ['tags.update', $tag->id],
                      'method' => 'PUT']) !!}

          {{ Form::label('name', 'Name:') }}
          {{ Form::text('name', null,
                      array('class' => 'form-control')) }}

          {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}

          {!! Html::linkRoute('tags.index', 'Cancel',
                    array($tag->id),
                    array('class' => 'btn btn-danger btn-block')) !!}
      {!! Form::close() !!}

    </div> <!-- col -->
  </div> <!-- row -->


@endsection
