@extends('layouts.author')

@section('content')

  @if(Session::has('success'))
    <p class="bg-danger">{{ session('success') }}</p>
  @endif

  <h1>Categories</h1>

  <div class="col-sm-4">
    {!! Form::open(['method' => 'POST', 'action' => 'AuthorCategoriesController@store']) !!}

    <div class="form-group">
      {{ Form::label('name', 'Name:') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::submit('Create Category', ['class' => 'btn btn-primary']) }}
    </div>

    {!! Form::close() !!}

  </div>

  <div class="col-sm-8">
    @if($categories)
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
          </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                <td>{{ $category->updated_at ? $category->updated_at->diffForHumans() : 'no date' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
  </div>


@endsection
