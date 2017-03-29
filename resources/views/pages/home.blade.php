@extends('app')

@section('template_title')
	Welcome {{ Auth::user()->name }}
@endsection

@section('content')
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
<div class="container">
		<div class="featurette" id="about">
				<div class="container">
					<?php $i=0; ?>

				<div class="row">
					<?php foreach ($posts as $post): ?>
						<div class="col-md-8">
							<div class="well">
									<div class="media">
										<div class="col-md-2">
											@if ($post->photo_id)
												<a class="pull-left" href="{{ route('posts.show', $post->id) }}">
														<img class="media-object" src="{{ $post->photo->file }}" width="100" height="100">
												</a>
											@else
												<a class="pull-left">
														<img class="media-object" src="http://www.tutorialspoint.com//scripts/img/logo-footer.png">
												</a>
											@endif
										</div> <!-- col-md-2 -->
										<div class="col-md-6">
											<div class="media-body">
													<h3 class="media-heading"><strong>{!! $post->title !!}</strong></h3>
													<p class="text-right">By {{ $post->user->name }}</p>
													<p>{!! str_limit(strip_tags($post->body), 800) !!}</p>
													<ul class="list-inline list-unstyled">
															<li><span><i class="fa fa-calendar"></i> {{ $post->created_at ? $post->created_at->diffForHumans() : "no date" }} </span></li>
															<li>|</li>
															<span><i class="glyphicon glyphicon-comment"></i> {{ $post->comments()->count() }} comments</span>
															<li>|</li>
															<li>
																	<span class="glyphicon glyphicon-star"></span>
																	<span class="glyphicon glyphicon-star"></span>
																	<span class="glyphicon glyphicon-star"></span>
																	<span class="glyphicon glyphicon-star"></span>
																	<span class="glyphicon glyphicon-star-empty"></span>
															</li>
															<li>|</li>
															<li>
																	<span><i class="fa fa-facebook-square"></i></span>
																	<span><i class="fa fa-twitter-square"></i></span>
																	<span><i class="fa fa-google-plus-square"></i></span>
															</li>
													</ul>
											</div> <!-- media body -->
										</div> <!-- col-md-6 -->
									</div> <!-- media -->
							</div> <!-- well -->
						</div> <!-- col-md-8 -->
					<?php endforeach; ?>

				<div style="padding-top: 70px;">
					<div class="table-responsive">
						<div class="widget-area" role="complementary">
								<div class="sidebar-inner block-section block-holder">
									<aside>
										<h3><span>Recent Posts</span></h3>
										<ul>
											@foreach ($posts as $post)
											 <li>
												 <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
											 </li>
											@endforeach
										</ul>
									</aside>
									<aside>
										<h3><span>Recent Comments</span></h3>
										<ul>
											@foreach ($comments as $comment)
												<li>
													<!-- <span>{{ $comment->user->name }}</span> on -->
													<a href="{{ route('all_users.show', $comment->user->id) }}">{{ $comment->user->name }}</a> on
													<a href="{{ route('posts.show', $comment->post->id) }}">{{ $comment->post->title }}</a>
												</li>
											@endforeach
										</ul>
									</aside>
									<aside>
										<h3><span>Recent Categories</span></h3>
										<ul>
											@foreach ($categories as $category)
												<li>
													<a href="{{ route('categories.show', $category->id) }}" >{{ $category->name }}</a>
												</li>
											@endforeach
										</ul>
									</aside>
									<aside>
										<h3><span>Recent Tags</span></h3>
										<ul>
											@foreach ($tags as $tag)
												<li>
													<a href="{{ route('tags.show', $tag->id) }}" >{{ $tag->name }}</a>
												</li>
											@endforeach
										</ul>
									</aside>

								</div>
							</div>
					</div>



				</div> <!-- row -->

		</div> <!-- container -->

	</div> <!-- feaurette -->

</div> <!-- container -->

@endsection
