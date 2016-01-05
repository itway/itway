<div class="remodal" data-remodal-id="photo">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>{{trans('post-form.add-image')}}</h1>
    <p>
    <div class="description">
        <label for="photoUpload" class="filelabel custom-file-input">
            @if(isset($model) && !empty($model->getMedia('images')->first()))
                <div class="photo-block">
                        <img style="" src="{!! url($model->getImage()) !!}" alt="">
                </div>
            @else
                <div class="photo-block"></div>
            @endif
            <span class="upload-span"><i class="icon-insert_photo"></i><br>Upload<br></span>
        </label>
        {!! Form::file('image', ['id' => 'photoUpload','class' => 'file-input', 'data-multiple-caption'=> null, 'placeholder' => 'insert your post image here      (max: 1 )']) !!}
    </div>
    </p>
    <br>
    <button data-remodal-action="confirm" class="remodal-confirm">Save</button>
</div>
