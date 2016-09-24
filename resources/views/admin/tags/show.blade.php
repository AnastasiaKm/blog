@extends('layouts.admin')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-1">
      <h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>
    </div> <!-- col -->
    <div class="col-md-2">
      <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-primary pull-right btn-block"
      style="margin-top:20px;">Edit</a>
    </div> <!-- col -->
    <div class="col-md-2">
      {!! Form::open(['route' => ['admin.tags.destroy', $tag->id],
                       'method' => 'DELETE']) !!}
      {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block',
                                  'style' => 'margin-top:20px;']) !!}
      {!! Form::close() !!}
    </div>
  </div> <!-- row -->

  <div class="row">
    <div class="col-md-6 col-md-offset-1">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Tags</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($tag->posts as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td>@foreach($post->tags as $tag)
                <span class="label label-default">{{ $tag->name }}</span>
                  @endforeach
              </td>
              <td><a href="{{ route('admin.posts.show', $post->id) }}"
                  class="btn btn-default btn-xs">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- col -->
  </div> <!-- row -->

@endsection
