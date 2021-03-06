<div class="l-12 m-12 s-12 create-form">
    <div class="two fields">
        <div class="field">
            <div class="title-block ">
                <span class="label titl">{{trans('post-form.title')}}</span>

                <div class="clearfix"></div>
                {!! Form::text('title', null, ['class' => 'input-line', 'id' => 'title','placeholder' => 'insert your title here'])!!}
                <div class="pos-rel">
                    <div class="input-count">left <span id="counter1"></span> symbols.</div>
                </div>
                <div class="clearfix"></div>
                {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>

        <div class="field">
            <div class="tag-block" style="z-index: 22!important;">
                <span class="label titl">#{{trans('post-form.tags')}}</span>

                <div class="clearfix"></div>
                {!! $tagsBuilder !!}
                <div class="clearfix"></div>
                {!! $errors->first('tags_list', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>

    </div>

    <div class="field">
        <div class="preamble-block">
            <span class="label titl">{{trans('post-form.preamble')}}</span>

            <div class="clearfix"></div>
            {!! Form::textarea('preamble', null, ['class' => 'input-line', 'id' => 'preamble','rows' => '3', 'placeholder' => 'insert your preamble here      (max:300)'])!!}
            <div class="pos-rel">
                <div class="input-count">left <span id="counter2"></span> symbols.</div>
            </div>
            <div class="clearfix"></div>
            {!! $errors->first('preamble', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <span class="label titl">{{trans('post-form.post body')}}</span>

    <div class="clearfix"></div>
    <div id="editormd">
        <textarea name="body" cols="120" rows="60" class="post-body input input-line hidden" id="editor" hidden
                  style="height:300px" placeholder="Please write your post!">@if(isset($post))<?php $body = $post->getBody();echo $body['body'];?>@endif</textarea>
    </div>
    <div class="clearfix"></div>
    {!! $errors->first('body', '<div class="text-danger">:message</div>') !!}
    <div class="two fields">
        <div class="field">
            <div class="btns-block">
                <span class="label titl">{{trans('post-form.attach')}}</span>

                <div class="clearfix"></div>
                @include('create-form.attach-block', [$model = isset($post) ? $post : null])
                @include('create-form.image-modal', [$model = isset($post) ? $post : null])
                @include('create-form.video-modal', [$model = isset($post) ? $post : null])
                @include('create-form.github-link', [$model = isset($post) ? $post : null])
                @include('create-form.poll-modal', [$model = isset($post) ? $post : null])
                <div class="clearfix"></div>
                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>

        <div class="field">
            <div class="time-block-addon">
            </div>
            <div class="time-block">
                <span class="label titl">{{trans('post-form.publish on')}}</span>

                <div class="clearfix"></div>
                @if(isset($postInstance))
                    <div class="form-group">
                        {!! Form::input('text', 'published_at', $postInstance->published_at ?  explode(" ",$postInstance->published_at)[0]: date('Y-m-d') , ['id'=> 'datepicker','class'=> 'input input-line datepicker'])!!}
                    </div>
                @else
                    <div class="form-group">
                        {!! Form::input('text', 'published_at', $post->published_at ? explode(" ", $post->published_at)[0] : date('Y-m-d') , ['id'=> 'datepicker', 'class'=> 'input input-line datepicker'])!!}
                    </div>
                @endif
                <div class="clearfix"></div>
                {!! $errors->first('date', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit($submitButton, ['class' => 'confirm button button-primary'])!!}
    </div>
</div>
@include('posts.create-post-scripts')
