<div id="wrapper">
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin: 0;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">{{ Lang::get('toggleNav') }}</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				{!! HTML::link(url('/'), Lang::get('titles.app'), array('class' => 'navbar-brand'), false) !!}
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>{!! HTML::link(url('/'), Lang::get('titles.home')) !!}</li>

					@if (!Auth::guest() && Auth::user()->hasRole('administrator'))

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Admin <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>
								<li>{!! HTML::link(url('/edit-users'), Lang::get('titles.adminEditUsers')) !!}</li>
								<li>{!! HTML::link(url('/users/create'), Lang::get('titles.adminNewUser')) !!}</li>
							</ul>
						</li>

					@endif

				</ul>
				<ul class="nav navbar-nav navbar-right">

					@if (Auth::guest())

						<li>{!! HTML::link(url('/auth/login'), Lang::get('titles.login')) !!}</li>
						<li>{!! HTML::link(url('/auth/register'), Lang::get('titles.register')) !!}</li>

					@else

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;" >
								<img src="/images/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%;">
								{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>{!! HTML::link(url('/profile/'.Auth::user()->name), Lang::get('titles.profile')) !!}</li>
								<li class="divider"></li>
								<li>{!! HTML::link(url('/auth/logout'), Lang::get('titles.logout')) !!}</li>
							</ul>
						</li>

					@endif

				</ul>
			</div>
			<div class="navbar-default sidebar" role="navigation">
			    <div class="sidebar-nav navbar-collapse">
			        <ul class="nav" id="side-menu">
			            <li>
			                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			            </li>


			            <li>
			                <a href="#"><i class="fa fa-wrench fa-fw"></i> Posts<span class="fa arrow"></span></a>
			                <ul class="nav nav-second-level">
			                    <li>
			                        <a href="{{ route('posts.index') }}">All Posts</a>
			                    </li>
													<li>
															<a href="{{ route('posts.edit-all') }}">Edit Posts</a>
													</li>
			                    <li>
			                        <a href="{{ route('posts.create') }}">Create Post</a>
			                    </li>
			                </ul>
			                <!-- /.nav-second-level -->
			            </li>

			            <li>
			                <a href="#"><i class="fa fa-wrench fa-fw"></i> Categories<span class="fa arrow"></span></a>
			                <ul class="nav nav-second-level">
			                    <li>
			                        <a href="{{ route('categories.index') }}">All Categories</a>
			                    </li>
			                    {{-- <li>
			                        <a href="buttons.html">Create Category</a>
			                    </li> --}}
			                </ul>
			                <!-- /.nav-second-level -->
			            </li>

			            <li>
			                <a href="#"><i class="fa fa-wrench fa-fw"></i> Tags<span class="fa arrow"></span></a>
			                <ul class="nav nav-second-level">
			                    <li>
			                        <a href="{{ route('tags.index') }}">All Tags</a>
			                    </li>
			                    {{-- <li>
			                        <a href="buttons.html">Create Category</a>
			                    </li> --}}
			                </ul>
			                <!-- /.nav-second-level -->
			            </li>

			        </ul>
			    </div>
			    <!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</div> <!-- container -->
	</nav>
</div> <!-- wrapper-->
