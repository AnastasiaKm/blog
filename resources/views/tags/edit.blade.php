@extends('app')

@section('content')

  <h1> Edit Tag</h1>

  <div class="col-sm-6">
      {!! Form::model($tag, ['method' => 'PUT', 'action' => ['TagsController@update', $tag->id]]) !!}

      <div class="form-group">
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
      </div>

        <div class="form-group">
          {{ Form::submit('Update Tag', ['class' => 'btn btn-primary col-sm-6']) }}
        </div>
        {!! Form::close() !!}

        {!! Html::linkRoute('tags.index', 'Cancel',
              array($tag->id),
              array('class' => 'btn btn-danger btn-block')) !!}

  </div>



@endsection
