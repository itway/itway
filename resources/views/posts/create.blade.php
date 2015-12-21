@extends('app')
@section('sitelocation')
    <?php  $name = 'CP'; ?>
    <?php  $msg = "CreatePost";  ?>
@endsection
@section('navigation.buttons')
    @include('posts.site-btns')
@endsection
@section('content')
    <div class="bg-white" style="">
    {!! Form::model( $postInstance = new Itway\Models\Post, ['url' => App::getLocale().'/blog/store', 'class' => 'ui form', 'id' => 'post-form', 'files' => true ] ) !!}
    @include('posts.post-form', ['submitButton' => 'Create Post', $post=null])
        <div class="clearfix"></div>
    {!! Form::close() !!}
    </div>
@endsection
