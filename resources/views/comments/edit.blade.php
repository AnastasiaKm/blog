@extends('app')

@section('template_linked_css')
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
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h2>Edit Comment</h2>

      {{ Form::model($comment, ['route' => ['comments.update', $comment->id],
                                'method' => 'PUT']) }}
        {{ Form::label('comment', 'Comment:') }}
        {{ Form::textarea('comment', null, ['class' => 'form-control']) }}

        {{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success',
                                           'style' => 'margin-top: 15px;']) }}

      {{ Form::close() }}
    </div>
  </div>

@endsection
