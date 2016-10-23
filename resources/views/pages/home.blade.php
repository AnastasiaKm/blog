@extends('app')

@section('template_title')
	Welcome {{ Auth::user()->name }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			{{-- <div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.home') }}</div>
				<div class="panel-body">
					<h1>
						Welcome <small>{{ Auth::user()->name }}</small>
					</h1>
					<p>
						{{ Lang::get('auth.loggedIn') }}
					</p>
				</div>
			</div> --}}
			<?php $i=0; ?>
			@if($posts)
				@foreach($posts as $post)
					@if(isset($post->photo_id))
						<?php $photo[$i] = $photos[$post->photo_id] ?>
						<?php $title[$i] = $post->title ?>
						<?php $body[$i] = $post->body ?>
						<?php $id[$i] = $post->id ?>
					@endif
					<?php $i = $i+1; ?>
				@endforeach
			@endif
			<div class="carousel slide" data-ride="carousel" id="featured">
				<ol class="carousel-indicators">
				  <li data-target="#featured" data-slide-to="0" class="active"></li>
				  <li data-target="#featured" data-slide-to="1"></li>
				  <li data-target="#featured" data-slide-to="2"></li>
				  <li data-target="#featured" data-slide-to="3"></li>
				  <li data-target="#featured" data-slide-to="4"></li>
				</ol>

			  <div class="carousel-inner" role="listbox">
					<div class="item active">
						<a href="{{ route('posts.show', $id[0] ) }}">
						 	<img src=" {{ $photo[0]->file }}" alt="..." width="750" height="400">
						</a>
						 <div class="carousel-caption">
							 <h3>{!! $title[0] !!}</h3>
							 <p>{!! str_limit(strip_tags($body[0]), 100) !!}</p>
						 </div>
					 </div>

					 <div class="item">
						 <a href="{{ route('posts.show', $id[1] ) }}">
				      	<img src="{{ $photo[1]->file }}" alt="..." width="750" height="400">
							</a>
				      <div class="carousel-caption">
								<h3>{{ $title[1] }}</h3>
								<p>{!! str_limit(strip_tags($body[1]), 100) !!}</p>
				      </div>
				    </div>

						<div class="item">
							<a href="{{ route('posts.show', $id[2] ) }}">
					      <img src="{{ $photo[2]->file }}" alt="..." width="750" height="400">
							</a>
				      <div class="carousel-caption">
								<h3>{{ $title[2] }}</h3>
								<p>{!! str_limit(strip_tags($body[2]), 100) !!}</p>
				      </div>
				    </div>

						<div class="item">
							<a href="{{ route('posts.show', $id[3] ) }}">
					      <img src="{{ $photo[3]->file }}" alt="..." width="750" height="400">
							</a>
				      <div class="carousel-caption">
								<h3>{{ $title[3] }}</h3>
								<p>{!! str_limit(strip_tags($body[3]), 100) !!}</p>
				      </div>
				    </div>

						<div class="item">
							<a href="{{ route('posts.show', $id[4] ) }}">
				      	<img src="{{ $photo[4]->file }}" alt="..." width="750" height="400">
							</a>
				      <div class="carousel-caption">
								<h3>{{ $title[4] }}</h3>
								<p>{!! str_limit(strip_tags($body[4]), 100) !!}</p>
				      </div>
				    </div>

				</div> <!-- carousel inner -->
				<a class="left carousel-control" href="#featured" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#featured" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>

			</div>  <!-- carousel -->

		</div>
	</div>
</div>
@endsection
