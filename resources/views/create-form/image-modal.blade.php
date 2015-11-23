<div class="remodal" data-remodal-id="photo">
  <button data-remodal-action="close" class="remodal-close"></button>
  <h1>{{trans('post-form.add-image')}}</h1>
  <p>
    <div class="description">
      <label for="fileupload" class="filelabel custom-file-input" >
          <i class="icon-insert_photo"></i>
          <span></span>
      </label>
      {!! Form::file('image', ['id' => 'fileupload','class' => 'file-input', 'data-multiple-caption'=> null, 'placeholder' => 'insert your post image here      (max: 1 )']) !!}
    </div>
    </p>
    <div class="form-group p">
        @if(isset($model))

            @if($model->picture())
                    <div class="s-12 m-12 l-12 xs-12">
                        <div class="thumbnail" style='background: #ffffff'>
                            @foreach($picture as $pic)
                                <img  class="img-responsive" style="" src="{!! asset('images/posts/' . $pic->path) !!}">
                            @endforeach

                        </div>
                    </div>

            @endif

        @endif

    </div>

  <br>
  <button data-remodal-action="confirm" class="remodal-confirm">Save</button>
</div>
