@extends('layouts.author')

@section('content')

  <h1> Edit Category</h1>

  <div class="col-sm-6">
    {{-- @if(Auth::user()->id == $category->user_id) --}}
      {!! Form::model($category, ['method' => 'PUT', 'action' => ['AuthorCategoriesController@update', $category->id]]) !!}

      <div class="form-group">
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
      </div>

      {{-- <div class="form-group">
        {{ Form::submit('Update Category', ['class' => 'btn btn-primary col-sm-6']) }}
      </div> --}}

      {!! Html::linkRoute('author.categories.index', 'Cancel',
            array($category->id),
            array('class' => 'btn btn-danger btn-block')) !!}



      {!! Form::close() !!}



  </div>



@endsection
