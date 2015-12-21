<div class="generic-create" data-modal="create-post">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h3>create your post</h3>
    <p>
    <div class="bg-white" style="">

        {!! Form::model( $postInstance = new Itway\Models\Post, ['url' => App::getLocale().'/blog/store', 'class' => 'ui form', 'id' => 'post-form', 'files' => true ] ) !!}

        @include('posts.post-form', ['submitButton' => 'Create Post', $post=null])

        <div class="clearfix"></div>

        {!! Form::close() !!}

    </div>
    </p>
</div>