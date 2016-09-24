@extends('layouts.admin')

@section('content')

  @if(Session::has('success'))
    <p class="bg-danger">{{ session('success') }}</p>
  @endif

  <h1>Posts</h1>

  <table class="table">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    <tbody>
      @if($posts)
        @foreach($posts as $post)
          <tr>
            <td> <img height="50" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" /> </td>
            <td> <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->user->name }}</a></td>
            <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ str_limit($post->body, 20) }}</td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>{{ $post->updated_at->diffForHumans() }}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
  <div class="text-center">
    {!! $posts->links(); !!}
  </div> <!-- text center -->


@endsection
