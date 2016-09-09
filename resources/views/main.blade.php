<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>

  <body>

    @include('partials._nav')

    <div class="container">
      @include('partials._messages')

      {{-- {{ Auth::check() ? "Logged in" : "Logged Out" }} --}}

      @yield('content')


    </div> <!-- container -->


      @include('partials._javascript')

      @yield('scripts')



  </body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        @include('partials._footer')
      </div>
    </div>
  </div>
</html>
