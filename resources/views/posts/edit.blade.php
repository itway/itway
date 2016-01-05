@extends('app')
@section('sitelocation')

    <?php  $name = 'UP'; ?>
    <?php  $msg = "UpdatePost";  ?>

@endsection

@section('navigation.buttons')
    @include('posts.site-btns')
@overwrite

@section('content')
    <div class="bg-white" style="">
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->id], 'class' => 'ui form', 'files' => true ]) !!}
        @include('posts.post-form', ['submitButton' => trans('forms.change')])
        <div class="clearfix"></div>
        {!! Form::close() !!}
    </div>
@overwrite
