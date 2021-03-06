@extends('app')

@section('template_linked_css')
  {!! HTML::style('css/select2.min.css') !!}
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
     tinymce.init({
       selector: 'textarea',
       plugins: 'link',
       menubar: false
     });
  </script>
@endsection

@section('content')

  <h1>Edit Post</h1>
  <div class="row">
    <div class="col-md-3">
      @if(isset($post->photo))
        {{-- <img src="{{ asset('images/' . $post->image) }}" class="img-responsive center-block"> --}}
        <img src="{{ $post->photo->file }}" class="img-responsive center-block">
      @endif
    </div>

    <div class="col-md-8">
    {!! Form::model($post, ['route' => ['posts.update', $post->id],
                    'method' => 'PUT', 'files' => true]) !!}

    <div class="form-group">
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('category_id', 'Category:') }}
      {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('tags', 'Tags:', [
                     'class' => 'form-spacing-top']) }}
      {{ Form::select('tags[]', $tags, null,  ['id'=>'tags',
                      'class' =>'form-control select2-multi',
                      'multiple' => 'multiple']) }}
    </div>

    {{-- <div class="form-group">
      {!! Form::label('tags', 'Tags:') !!}
      {!! Form::select('tags[]', $tags, null, ['class' => 'form-control', 'multiple']) !!}
    </div> --}}

    <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('body', 'Body:') }}
      {{ Form::textarea('body', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::submit('Update Post', ['class' => 'btn btn-primary col-sm-6']) }}
    </div>

    {!! Form::close() !!}

    {!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
    <div class="form-group">
      {{ Form::submit('Delete Post', ['class' => 'btn btn-danger col-sm-6']) }}
    </div>
    {!! Form::close() !!}
  </div>

  </div> <!-- row -->

  {{-- <div class="row">
    @include('includes.form_error')
  </div> --}}

@endsection

@section('template_scripts')
  {!! HTML::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2();
    $('.select2-multi').select().
    val({!! json_encode($post->tags()->getRelatedIds()) !!}).
    trigger('change');
  </script>
@endsection
{{-- @section('footer')
  <script>
    $('#tags').select2();
  </script>
@endsection --}}
