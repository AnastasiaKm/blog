@extends('layouts.admin')

@section('content')
  @if(Session::has('success'))
    <p class="bg-danger">{{ session('success') }}</p>
  @endif

  <h1>Media</h1>

  @if($photos)
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Created at</th>
          <th>Updated at</th>
        </tr>
      </thead>
      <tbody>
        @foreach($photos as $photo)
          <tr>
            <td><img height="50" src="{{ $photo->file }}" /> </td>
            <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : 'no date' }}</td>
            <td>{{ $photo->updated_at ? $photo->updated_at->diffForHumans() : 'no date' }}</td>
            <td>
              {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
              <div class="form-group">
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              </div>
              {!! Form::close() !!}
            </td>
          </tr>
      @endforeach
      </tbody>
    </table>
  @endif


@endsection
