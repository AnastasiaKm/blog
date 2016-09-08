@extends('main')

@section('title', '| Login')

@section('content')

  {{-- if i create the form without form helper (from collectives) in laravel site,
  we must manually include csrf protection using the following command
      <form>
      {!! csrf_field()  !!}
      </form> --}}
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      {!! Form::open() !!}
          {{ Form::label('email', 'Email:') }}
          {{ Form::email('email', null, ['class' => 'form-control']) }}

          {{ Form::label('password', 'Password:', ['class' => 'form-spacing-top']) }}
          {{ Form::password('password', ['class' => 'form-control']) }}

          {{ Form::checkbox('remember') }}
          {{ Form::label('remember', "Remember Me", ['class' => 'form-spacing-top']) }}

          <br>
          {{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}

          <a href="{{ url('password/reset') }}">Forgot my Password</a>
      {!! Form::close() !!}
    </div> <!-- col -->
  </div> <!-- row -->

@endsection
