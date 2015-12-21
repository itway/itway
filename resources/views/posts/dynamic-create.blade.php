{!! Form::model( $postInstance = new Itway\Models\Post, ['url' => App::getLocale().'/blog/store', 'class' => 'ui form', 'id' => 'post-form', 'files' => true ] ) !!}
@include('posts.post-form', ['submitButton' => 'Create Post', $post=null])
<div class="clearfix"></div>
{!! Form::close() !!}