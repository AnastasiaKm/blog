@extends('app')

@section('template_linked_css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
@endsection

@section('template_fastload_css')
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10">

        @if(Session::has('success'))
          <p class="bg-danger">{{ session('success') }}</p>
        @endif

        <h1>Posts</h1>

        <div class="table-responsive">
          <table id="post_table" class="table table-striped table-hover table-condensed">
            <thead>
              <tr class="info">
                <th>Photo</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Updated at</th>
              </tr>
            </thead>
            <tbody>
              @if($all_posts)
                @foreach($all_posts as $post)
                  <tr>
                    <td> <img height="50" src="{{ $post->photo_id ? $post->photo->file : 'http://placehold.it/400x400' }}" /> </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                    <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                    <td>{{ $post->created_at ? $post->created_at->diffForHumans() : "no date" }}</td>
                    <td>{{ $post->updated_at ? $post->updated_at->diffForHumans() : "no date" }}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div> <!-- col -->
    </div> <!-- row -->
  </div> <!-- container -->
@endsection

@section('template_scripts')

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function () {
			$('#post_table').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true
			});
		});
    </script>

@endsection
