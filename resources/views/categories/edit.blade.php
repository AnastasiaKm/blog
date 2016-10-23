@extends('app')

@section('content')

  <h1> Edit Category</h1>

  <div class="col-sm-6">
    @if(Auth::user()->hasRole('administrator'))
      {!! Form::model($category, ['method' => 'PUT', 'action' => ['CategoriesController@update', $category->id]]) !!}

      <div class="form-group">
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
      </div>

      {{-- {!! Html::linkRoute('categories.index', 'Cancel',
            array($category->id),
            array('class' => 'btn btn-danger btn-block')) !!} --}}

        <div class="form-group">
          {{ Form::submit('Update Category', ['class' => 'btn btn-primary col-sm-6']) }}
        </div>
        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['CategoriesController@destroy', $category->id]]) !!}
        <div class="form-group">
          {{ Form::submit('Delete Category', ['class' => 'btn btn-danger col-sm-6']) }}
        </div>
        {!! Form::close() !!}
      @endif







  </div>



@endsection
