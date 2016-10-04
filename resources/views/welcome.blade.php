@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                {{-- <div class="carousel slide" data-ride="carousel" id="featured">

                  <ol class="carousel-indicators">
                    <li data-target="#featured" data-slide-to="0" class="active"></li>
                    <li data-target="#featured" data-slide-to="1"></li>
                    <li data-target="#featured" data-slide-to="2"></li>
                    <li data-target="#featured" data-slide-to="3"></li>
                  </ol>

                    <div class="carousel-inner">
                      <div class="item active">

                        <img src="images/carousel-lifestyle.jpg" alt="Lifestyle Photo">
                        <div class="carousel-caption">
                          <h3>Headline</h3>
                          <p>jbwsbxcuqba iavbihab nxklna dxaob ckjsb lkfn fcndjlsfclsobcjslb cndcSJBDWNSB </p>
                        </div>
                      </div>
                      <div class="item">
                        <img src="images/carousel-mission.jpg" alt="Mission">
                      </div>
                      <div class="item">
                        <img src="images/carousel-vaccinations.jpg" alt="Vaccinations">
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

                  </div>  <!-- carousel --> --}}


                <div class="panel-body">
                    Welcome to my blog!
                    {{-- <a href="{{ url('/admin') }}">Admin, </a>
                    <a href="{{ url('/author') }}">Author</a> --}}
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
