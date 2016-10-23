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
  <div class="row">
    <div class="col-md-6">


      <h1>Create Post</h1>

      <div class="row">
        {!! Form::open(['method' => 'POST', 'action' => 'PostsController@store',
                        'files' => true]) !!}

        <div class="form-group">
          {{ Form::label('title', 'Title:') }}
          {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
          {{ Form::label('category_id', 'Category:') }}
          {{ Form::select('category_id', ['' => 'Choose Category'] + $categories, null,
                          ['class' => 'form-control']) }}
        </div>


        <div class="form-group">
          {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
            <select class="form-control select2-multi" name="tags[]"
                    multiple="multiple">
              @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach
            </select>
          </div>

        <div class="form-group">
          {{ Form::label('photo_id', 'Photo:', ['class' => 'form-spacing-top']) }}
          {{ Form::file('photo_id', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
          {{ Form::label('body', 'Body:') }}
          {{ Form::textarea('body', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
          {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
        </div>

        {!! Form::close() !!}

      </div> <!-- row -->

      {{-- <div class="row">
        @include('includes.form_error')
      </div> --}}
    </div>
  </div>

@endsection

@section('template_scripts')
  {!! HTML::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2({
      placeholder: 'Choose a tag',
      tags: true,
      // ajax: {
      //   dataType: 'json',
      //   url: 'api/tags',
      //   delay: 250,
      //   data: function(params) {
      //     return {
      //       q: params.term
      //     }
      //   },
      //   processResults: function(data) {
      //     return { results: data}
      //   }
      // }
    });
  </script>
@endsection
