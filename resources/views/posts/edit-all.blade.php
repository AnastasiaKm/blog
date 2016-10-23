@extends('app')


@section('template_linked_css')
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> --}}

	{!! HTML::style(asset('https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

	    <div class="container-fluid">

			<h2>Edit Posts</h2>

			@include('partials.form-status')

			<div class="table-responsive">
				<table id="posts_table" class="table table-striped table-hover table-condensed">
					<thead>
						<tr class="success">
              <th>Photo</th>
              <th>Owner</th>
              <th>Category</th>
              <th>Title</th>
              <th>Created at</th>
              <th>Updated at</th>
							<th colspan="3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@if($posts)
							@foreach($posts as $post)
								<tr>
	                <td> <img height="50" src="{{ $post->photo_id ? $post->photo->file : 'http://placehold.it/400x400' }}" /> </td>
	                <td>{{ $post->user->name }}</td>
	                <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
	                <td>{{ $post->title }}</td>
	                <td>{{ $post->created_at->diffForHumans() }}</td>
	                <td>{{ $post->updated_at->diffForHumans() }}</td>
									<td>
										{!! Form::open(array('url' => 'posts/' . $post->id, 'class' => 'pull-right')) !!}
											{!! Form::hidden('_method', 'DELETE') !!}
											{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete this Post', array('class' => 'btn btn-danger btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Post', 'data-message' => 'Are you sure you want to delete this post ?')) !!}
										{!! Form::close() !!}
									</td>
									<td>
										<a class="btn btn-small btn-info btn-block btn-flat" href="{{ URL::to('posts/' . $post->id . '/edit') }}"><i class=" fa fa-pencil fa-fw"></i> Edit this Post</a>
									</td>
									<td>
										<a class="btn btn-small btn-success btn-block btn-flat" href="{{ route('posts.show', $post->id) }}">Show this Post</a>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>

			@include('modals.modal-delete')

			<div class="row margin-top-1">

				<div class="col-md-3">
					{!! HTML::icon_link( "/posts/create", 'fa-fw fa '.Lang::get('links-and-buttons.link_icon_post_create'), Lang::get('links-and-buttons.link_title_post_create'), array('class' =>'btn btn-primary btn-flat btn-block')) !!}
				</div>

			</div>

	    </div>

@endsection

@section('template_scripts')

	<script type="text/javascript" src="https://cdn.datatables.net/1.12.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

	<script>
		$(document).ready(function () {
			$('#posts_table').DataTable({
				columns: [
					{ title: "Photo"},
					{ title: "Owner"},
					{ title: "Category"},
					{ title: "Title"},
					{ title: "Body"},
					{ title: "Created at"},
					{ title: "Updated at"},
					{ title: "Actions"}
				]
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});
  </script>

	@include('scripts.delete-modal-script')
	@include('scripts.save-modal-script')

@endsection
