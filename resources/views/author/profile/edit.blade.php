@extends('layouts.author')

@section('content')
<div class="container">
    <div class="row">
          <div class="col-sm-3">
            <img class="img-responsive" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"
            {{-- src="{{ $user->avatar ? $user->avatar : 'http://placehold.it/400x400' }}" /> --}}
            src="/images/{{ $user->avatar }}" />
          </div>

          <div class="col-sm-5 ">
          <h2>{{ $user->name }}'s Profile</h2>
          {{ Form::model($user, ['route' => ['author.profile.update', $user->id],
                                    'method' => 'PUT', 'files' => true]) }}
              <div class="form-group">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>

              <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}
              </div>


              <div class="form-group">
                {{ Form::label('avatar', 'Photo:') }}
                {{ Form::file('avatar', null, ['class' => 'form-control']) }}
              </div>

              <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
              </div>

              <div class="form-group">
                {{ Form::submit('Update User', ['class' => 'btn btn-primary']) }}
              </div>

          {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
