@extends('layouts.author')

@section('content')

  <h1>Create Post</h1>

  <div class="row">
    {!! Form::open(['method' => 'POST', 'action' => 'AuthorPostsController@store',
                    'files' => true]) !!}

    <div class="form-group">
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('category_id', 'Category:') }}
      {{ Form::select('category_id', ['' => 'Choose Categories'] + $categories, null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('body', 'Body:') }}
      {{ Form::textarea('body', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
    </div>

    {!! Form::close() !!}

  </div> <!-- row -->

  <div class="row">
    @include('includes.form_error')
  </div>

@endsection
