@extends('main')

@section('title', '| Forgot My Password')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          {!! Form::open(['url' => 'password/reset', 'method' => 'POST']) !!}

          {{ Form::hidden('token', $token) }}

          {{ Form::label('email', 'Email Address:') }}
          {{ Form::email('email', $email, ['class' => 'form-control']) }}

          {{ Form::label('password', 'New Password:') }}
          {{ Form::password('password', ['class' => 'form-control']) }}

          {{ Form::label('password_confirmation', 'Confirm New Password:') }}
          {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

          {{ Form::submit('Reset Password', ['class' => 'btn btn-primary']) }}

          {!! Form::close() !!}
        </div>
      </div> <!-- panel -->
    </div> <!-- col -->
  </div> <!-- row -->

@endsection
