@extends('main')

@section('title', '| All Posts')

@section('content')

  <div class="row">
    <div class="col-md-4 col-md-offset-2">
      <h1>All Posts</h1>
    </div> <!-- col -->

    <div class="col-md-2 col-md-offset-1">
      <a href="{{ route('posts.create') }}"
        class="btn btn-primary btn-block btn-h1-spacing">
        <img src="/images/post.jpg" class="img-responsive center-block"><strong> Create New Post</strong>
      </a>
    </div> <!-- col -->
    <div class="col-md-12">
      <hr>
    </div> <!-- col -->
  </div> <!-- row -->

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <table class="table">
        <thead>
          {{-- <th>#</th> --}}
          <th>Title</th>
          <th>Body</th>
          <th>Created At</th>
          <th></th>
        </thead>

        <tbody>
          @foreach($posts as $post)
            <tr>
              {{-- <th>{{ $post->id }}</th> --}}
              <td>{{ $post->title }}</td>
              <td>{{ substr(strip_tags($post->body), 0, 50) }}
                  {{ strlen(strip_tags($post->body)) >50 ? "..." : "" }}</td>
              <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                <td><a href="{{ route('posts.show', $post->id) }}"
                      class="btn btn-default btn-sm" >View</a>
                    <a href="{{ route('posts.edit', $post->id) }}"
                      class="btn btn-default btn-sm">Edit</a>
                </td>
                <td>
                    <a>{!! Form::open(['route' =>['posts.destroy', $post->id],
                                      'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete',
                                        ['class' => 'btn btn-default btn-sm']) !!}
                        {!! Form::close() !!}
                    </a>
                </td>
            </tr>

          @endforeach
        </tbody>
      </table>
      <div class="text-center">
        {!! $posts->links(); !!}
      </div> <!-- text center -->
    </div> <!-- col -->
  </div> <!-- row -->

@endsection
