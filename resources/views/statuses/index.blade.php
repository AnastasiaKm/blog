@extends('app')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    @include ('statuses.partials.publish-status-form')

    @include ('statuses.partials.statuses')
  </div> <!-- col-md-6 -->
</div> <!-- row -->


@endsection
