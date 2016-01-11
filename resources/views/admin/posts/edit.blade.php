@extends('admin/app')
@section('navigation.buttons')
    @include('posts.site-btns')
@overwrite
@section('content')
    <div class="row admin-block">
        <div class="bg-white" style="">
            {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->id], 'class' => 'ui form', 'files' => true ]) !!}
            @include('posts.post-form', ['submitButton' => trans('forms.change')])
            <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
@overwrite