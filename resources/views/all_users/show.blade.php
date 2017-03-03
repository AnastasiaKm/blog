@extends('app')

@section('content')
  <div class="row">
    @include('partials.form-status')
    <div class="col-md-4">
      <div class="media">
        <div class="pull-left">
          <img class="media-object img-circle avatar" src="/images/{{ $user->avatar }}"
               alt="{{ $user->name }}"
               width="70" height="70">
        </div> <!-- pull-left -->

        <div class="media-body">
          <h1 class="media-heading">{{ $user->name }}</h1>
          <ul class="list-inline text-muted">
            <li>{{ $statusCount = $user->statuses->count() }} {{ str_plural('Status', $statusCount) }}</li>
            <li>{{ $followerCount = $user->followers()->count() }} {{ str_plural('Follower', $followerCount) }}</li>
          </ul>

          @foreach ($user->followers as $follower)
            @include('partials.avatar', ['user' => $follower])
          @endforeach
        </div> <!-- media-body -->
      </div> <!-- media -->
    </div> <!-- col-md-3 -->
    <div class="col-md-6">
      @unless ($user->id == Auth::user()->id)
        @include('all_users.partials.follow-form')
      @endif

      @if ($user->id == Auth::user()->id)
        @include ('statuses.partials.publish-status-form')
      @endif

      @include ('statuses.partials.statuses', ['statuses' => $user->statuses])
    </div>
  </div>

@endsection
