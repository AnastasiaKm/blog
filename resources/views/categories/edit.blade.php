@extends('main')

@section('title', '| Edit A Category')

@section('content')

  <div class="row">
    <div class="col-md-4 col-md-offset-1">
      <h1>Edit The Category</h1>
      <hr>


      {!! Form::model($category, ['route' => ['categories.update', $category->id],
                      'method' => 'PUT']) !!}

          {{ Form::label('name', 'Name:') }}
          {{ Form::text('name', null,
                      array('class' => 'form-control')) }}

          {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}

          {!! Html::linkRoute('categories.index', 'Cancel',
                    array($category->id),
                    array('class' => 'btn btn-danger btn-block')) !!}
      {!! Form::close() !!}

    </div> <!-- col -->
  </div> <!-- row -->


@endsection
