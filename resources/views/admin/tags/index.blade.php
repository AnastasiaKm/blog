@extends('layouts.admin')

@section('content')

  @if(Session::has('success'))
    <p class="bg-danger">{{ session('success') }}</p>
  @endif

  <h1>Tags</h1>

  <div class="col-sm-4">
    {!! Form::open(['method' => 'POST', 'action' => 'AdminTagsController@store']) !!}

    <div class="form-group">
      {{ Form::label('name', 'Name:') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::submit('Create Tag', ['class' => 'btn btn-primary']) }}
    </div>

    {!! Form::close() !!}

  </div>

  <div class="col-sm-8">
    @if($tags)
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
          </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
              <tr>
                <td><a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                <td>{{ $tag->created_at ? $tag->created_at->diffForHumans() : 'no date' }}</td>
                <td>{{ $tag->updated_at ? $tag->updated_at->diffForHumans() : 'no date' }}</td>
                {{-- <td><a href="{{ route('admin.tags.edit', $tag->id) }}"
                      class="btn btn-default btn-sm">Edit</a>
                </td>
                <td>
                    <a>{!! Form::open(['route' =>['admin.tags.destroy', $tag->id],
                                      'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete',
                                        ['class' => 'btn btn-default btn-sm']) !!}
                        {!! Form::close() !!}
                    </a>
                </td> --}}

              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
  </div>
  <div class="col-sm-8 col-sm-offset-4">
    <div class="text-center">
      {!! $tags->links(); !!}
    </div> <!-- text center -->
  </div>



@endsection
