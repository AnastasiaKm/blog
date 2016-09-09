@extends('main')

@section('title', '| All Categories')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <h1>Categories</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default">Edit</a></td>
              <td>
                  <a>{!! Form::open(['route' =>['categories.destroy', $category->id],
                                    'method' => 'DELETE']) !!}
                      {!! Form::submit('Delete',
                                      ['class' => 'btn btn-default']) !!}
                      {!! Form::close() !!}
                  </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- col -->

    <div class="col-md-2 col-md-offset-1">
      <div class="well">
        {!! Form::open(['route' => 'categories.store',
                        'method' => 'POST']) !!}
            <h2>New Category</h2>
            {{ Form:: label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}

            {{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

        {!! Form::close() !!}

      </div><!-- well -->

    </div> <!-- col -->
  </div> <!-- row -->

@endsection
