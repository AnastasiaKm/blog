<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
		<title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ Lang::get('titles.app') }} </title>

		{{-- FONTS --}}
		{!! HTML::style('//fonts.googleapis.com/css?family=Roboto:400,300', array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		@yield('template_linked_fonts')

		{{-- STYLESHEETS --}}
		{!! HTML::style(asset('/css/app.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		{!! HTML::style(asset('/css/blog-post.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		{!! HTML::style(asset('/css/bootstrap.min.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		{!! HTML::style(asset('/css/font-awesome.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		{!! HTML::style(asset('/css/metisMenu.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		{!! HTML::style(asset('/css/sb-admin-2.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
		{!! HTML::style(asset('/css/timeline.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}


		{{-- {!! HTML::style(asset('/css/libs.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!} --}}
		{!! HTML::style(asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}

		@yield('template_linked_css')

		<style type="text/css">
			@yield('template_fastload_css')
		</style>

	    {{-- HTML5 Shim and Respond.js for IE8 support --}}
	    <!--[if lt IE 9]>
	      {!! HTML::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', array('type' => 'text/javascript')) !!}
	      {!! HTML::script('//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js', array('type' => 'text/javascript')) !!}
	      {!! HTML::script('//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js', array('type' => 'text/javascript')) !!}
	      {!! HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', array('type' => 'text/javascript')) !!}
	    <![endif]-->
	    <!--[if gte IE 9]>
	      <style type="text/css">.gradient {filter: none;}</style>
	    <![endif]-->



	</head>
	<body>

		@include('partials.nav')
<div id="page-wrapper">
		@yield('content')
</div>

		{{-- SCRIPTS --}}
		{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array('type' => 'text/javascript')) !!}
		{{-- {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js', array('type' => 'text/javascript')) !!} --}}
		{!! HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
		<script src="http://code.jquery.com/jquery-1.12.3.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/metisMenu.js"></script>
		<script src="/js/npm.js"></script>
		<script src="/js/sb-admin-2.js"></script>

		@yield('template_scripts')

	</body>
	<footer>
	  <div id="copyright text-right" class="text-center">© Copyright 2016 Karamichailidou Anastasia</div>

	</footer>

</html>
