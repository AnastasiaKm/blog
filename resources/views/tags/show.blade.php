@extends('app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>
    </div> <!-- col -->
    <div class="col-md-6">
      @if(Auth::user()->hasRole('administrator'))
        <div class="col-md-3">
          <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary pull-right btn-block"
          style="margin-top:20px;">Edit</a>
        </div> <!-- col -->
        <div class="col-md-3">
          {!! Form::open(['route' => ['tags.destroy', $tag->id],
                           'method' => 'DELETE']) !!}
          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block',
                                      'style' => 'margin-top:20px;']) !!}
          {!! Form::close() !!}
      @else
        <div class="col-md-3">
          {!! HTML::linkRoute('tags.index', 'Cancel',
              array($tag->id),
              array('class' => 'btn btn-danger btn-block')) !!}
        </div>
      @endif
    </div>
  </div> <!-- row -->

  <div class="row">
    <div class="col-md-6 col-md-offset-1">
      <table class="table">
        <thead>
          <tr class="success">
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
              <td><a href="{{ route('posts.show', $post->id) }}"
                  class="btn btn-default btn-xs">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- col -->
  </div> <!-- row -->

@endsection
