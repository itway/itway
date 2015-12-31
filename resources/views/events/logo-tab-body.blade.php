<div class="ui top attached tab " data-tab="logo">
    <span class="label titl">{{trans('event-form.logo')}}</span>

    <div class="description">
        <label for="photoUpload" class="filelabel filelabel-event custom-file-input">
            @if(isset($event) && $event->picture())
                <div class="photo-block">
                    <div class="thumbnail" style='background: #ffffff'>
                        @foreach($picture as $pic)
                            <img class="img-responsive" style=""
                                 src="{!! asset('images/events/' . $pic->path) !!}">
                        @endforeach
                    </div>
                </div>
            @else
                <div class="photo-block"></div>
            @endif
            <span class="upload-span"><i class="fa fa-camera fa-2x"></i><br>Upload<br>event logo</span>
        </label>
        {!! Form::file('logo',
        ['id' => 'photoUpload',
        'class' => 'file-input',
        'data-multiple-caption'=> null,
        'placeholder' => 'insert your post image here      (max: 1 )']) !!}
    </div>
    <br></div>
