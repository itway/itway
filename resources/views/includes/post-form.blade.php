<div class="l-12 m-12 s-12">
    <h3 class="label titl">{{trans('post-form.title')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::text('title', null, ['class' => 'input input-line', 'id' => 'title','placeholder' => 'insert your title here      (max:120)'])!!}

    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="counter1"></span> symbols.</div>
    </div>
    <div class="clearfix"></div>

    {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}

    <h3 class="label titl">{{trans('post-form.preamble')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::textarea('preamble', null, ['class' => 'input input-line', 'id' => 'preamble','rows' => '3', 'placeholder' => 'insert your preamble here      (max:300)'])!!}

    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="counter2"></span> symbols.</div>
    </div>
    <div class="clearfix"></div>

    {!! $errors->first('preamble', '<div class="text-danger">:message</div>') !!}

    <h3 class="label titl">{{trans('post-form.img')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        <label for="fileupload" class="filelabel custom-file-input" >
            <i class="icon-file_download"></i>
            <span></span>
        </label>
        {!! Form::file('image', ['id' => 'fileupload','class' => 'file-input', 'data-multiple-caption'=> null, 'placeholder' => 'insert your post image here      (max: 1 )']) !!}
    </div>


    <div class="clearfix"></div>

    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}

    <div class="row">
        <div class="form-group p">
            @if(isset($post))

                @if($post->picture())
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

    </div>
    <div class="clearfix"></div>


    <h3 class="label">{{trans('post-form.post body')}}</h3>
    <div class="clearfix"></div>

    <div class="form-group">

        {!! Form::textarea('body', null, [ 'cols' => '120', 'rows'=>'60', 'class' => 'input input-line hidden', 'id' => 'editor', 'hidden', 'style' => 'height:300px', 'placeholder' => 'Please write your post!'])!!}

    </div>
    <div class="clearfix"></div>

    {!! $errors->first('body', '<div class="text-danger">:message</div>') !!}



    <h3 class="label">{{trans('post-form.publish on')}}</h3>
    <div class="clearfix"></div>
    @if(isset($postInstance))
        <div class="form-group">
            {!! Form::input('date', 'published_at', $postInstance->published_at ?  explode(" ",$postInstance->published_at)[0]: date('Y-m-d') , ['class'=> 'input input-line'])!!}
        </div>
    @else
        <div class="form-group">
            {!! Form::input('date', 'published_at', $post->published_at ? explode(" ", $post->published_at)[0] : date('Y-m-d') , ['class'=> 'input input-line'])!!}
        </div>
    @endif
    <div class="clearfix"></div>

    {!! $errors->first('date', '<div class="text-danger">:message</div>') !!}


    <h3 class="label">{{trans('post-form.tags')}}</h3>
    <div class="clearfix"></div>

    <div class="form-group">

            <div data-tags-input-name="tags_list" id="tagBox" ></div>
    </div>
    <div class="clearfix"></div>

    {!! $errors->first('tags_list', '<div class="text-danger">:message</div>') !!}

    <div class="form-group">
        {!! Form::submit($submitButton, ['class' => 'confirm button button-primary'])!!}
    </div>



</div>
@include('includes.create-post-scripts')