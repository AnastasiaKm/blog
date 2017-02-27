@extends('app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>{{ $category->name }} Category <small>{{ $category->posts()->count() }} Posts</small></h1>
    </div> <!-- col -->
    <div class="col-md-6">
      @if(Auth::user()->hasRole('administrator'))
        <div class="col-md-3">
          <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary pull-right btn-block"
          style="margin-top:20px;">Edit</a>
        </div> <!-- col -->
        <div class="col-md-3">
          {!! Form::open(['route' => ['categories.destroy', $category->id],
                           'method' => 'DELETE']) !!}
          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block',
                                      'style' => 'margin-top:20px;']) !!}
          {!! Form::close() !!}
        </div>
      @else
        <div class="col-md-3">
          {!! HTML::linkRoute('categories.index', 'Cancel',
              array($category->id),
              array('class' => 'btn btn-danger btn-block')) !!}
        </div>
      @endif
  </div> <!-- row -->

  <div class="row">
    <div class="col-md-6 col-md-offset-1">
      <table class="table">
        <thead>
          <tr class="info">
            <th>Title</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td><a href="{{ route('posts.show', $post->id) }}"
                  class="btn btn-default btn-xs">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- col -->
  </div> <!-- row -->

@endsection
