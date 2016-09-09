@extends('main')

@section('title', '| All Tags')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <h1>Tags</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tags as $tag)
            <tr>
              <td>
                <a href="{{ route('tags.show', $tag->id) }}">
                 {{ $tag->name }}  </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- col -->

    <div class="col-md-2 col-md-offset-1">
      <div class="well">
        {!! Form::open(['route' => 'tags.store',
                        'method' => 'POST']) !!}
            <h2>New Tag</h2>
            {{ Form:: label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}

            {{ Form::submit('Create New Tag', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

        {!! Form::close() !!}

      </div><!-- well -->

    </div> <!-- col -->
  </div> <!-- row -->

@endsection
