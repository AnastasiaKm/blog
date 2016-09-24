@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Welcome to my blog. Choose your role!
                    <a href="{{ url('/admin') }}">Admin, </a>
                    <a href="{{ url('/author') }}">Author</a
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
