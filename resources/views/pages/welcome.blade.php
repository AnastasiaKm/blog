@extends('main')

@section('title', '| Homepage')

@section('content')
  <div class="col-md-5 col-md-offset-3">
    <div class="carousel slide" data-ride="carousel" id="featured">

    <ol class="carousel-indicators">
      <li data-target="#featured" data-slide-to="0" class="active"></li>
      <li data-target="#featured" data-slide-to="1"></li>
      <li data-target="#featured" data-slide-to="2"></li>
      <li data-target="#featured" data-slide-to="3"></li>
    </ol>

      <div class="carousel-inner">
        <div class="item active">
          <img src="images/my_blog.jpg" class="image-center" alt="My Blog Photo">
        </div>
        <div class="item">
          <img src="images/vegetables.jpg" class="image-center" alt="Vegetables">
        </div>
        <div class="item">
          <img src="images/cake.jpg" class="image-center" alt="Cake">
        </div>
        <div class="item">
          <img src="images/games.jpg" class="image-center" alt="Games">
        </div>

      </div> <!-- carousel inner -->

      <a class="left carousel-control"
        href="#featured" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>

      <a class="right carousel-control"
        href="#featured" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>

    </div>  <!-- carousel -->
  </div> <!-- col -->

      <div class="row">
        <div class="col-md-8">
          @foreach($posts as $post)

            <div class="post">
              <h3>{{ $post->title }}</h3>
              <p> {{ substr(strip_tags($post->body), 0, 300) }}
                  {{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}</p>
              <a href="{{ url('blog/' . $post->slug) }}" class="btn btn-primary">Read more</a>
            </div> <!-- post -->

            <hr>
          @endforeach


        {{-- <div class="col-md-3 col-md-offset-1">
          <h2>Sidebar</h2>
        </div> <!-- col --> --}}
      </div> <!-- row -->
@endsection
