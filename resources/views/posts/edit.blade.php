@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
      tinymce.init({
        selector: "textarea",
        plugins: "link",
        menubar:false
      });
    </script>
@endsection

@section('content')

  <div class="row">
    <div class="col-md-4">
      <img class="img-responsive center-block" src="/images/keep_calm.jpg">
    </div>
    <div class="col-md-6 col-md-offset-1">
      <h1>Edit Your Post</h1>
      <hr>


      {!! Form::model($post, ['route' => ['posts.update', $post->id],
                      'method' => 'PUT', 'files' => true]) !!}
          {{ Form::label('title', 'Title:') }}
          {{ Form::text('title', null,
            array('class' => 'form-control input-lg')) }}

          {{ Form::label('slug', 'Slug:', ['class'
                    => 'form-spacing-top']) }}
          {{ Form::text('slug', null,
            array('class' => 'form-control')) }}

          {{ Form::label('category_id', 'Category:', [
                         'class' => 'form-spacing-top']) }}
          {{ Form::select('category_id', $categories, null, [
                          'class' => 'form-control']) }}

          {{-- We will use an API in order to programmatic access and
          populate the "select" with the tags that already existed
          in the db. This is dont to the script section --}}
          {{ Form::label('tags', 'Tags:', [
                         'class' => 'form-spacing-top']) }}
          {{ Form::select('tags[]', $tags, null, [
                          'class' =>'form-control select2-multi',
                          'multiple' => 'multiple']) }}

          {{ Form::label('featured_image', 'Update featured image', ['class' => 'form-spacing-top']) }}
          {{ Form::file('featured_image') }}

          {{ Form::label('body', 'Post Body:', [
                         'class' => 'form-spacing-top']) }}
          {{ Form::textarea('body', null,
                      array('class' => 'form-control')) }}

          {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}

          {!! Html::linkRoute('posts.show', 'Cancel',
                    array($post->id),
                    array('class' => 'btn btn-danger btn-block')) !!}
      {!! Form::close() !!}

    </div> <!-- col -->
  </div> <!-- row -->


@endsection

@section('scripts')
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2();
    $('.select2-multi').select().
    val({!! json_encode($post->tags()->getRelatedIds()) !!}).
    trigger('change');
  </script>
@endsection
