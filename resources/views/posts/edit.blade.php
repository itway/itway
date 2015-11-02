@extends('app')
@section('sitelocation')

    <?php  $name = 'UP'; ?>
    <?php  $msg = "UpdatePost";  ?>

@endsection

@section('subnavigation.buttons')
    @include('posts.site-btns')
@endsection

@section('content')
    <div class="bg-white" style="  display: flex;">

        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->slug], 'class' => 'form', 'files' => true ]) !!}

        @include('includes.post-form', ['submitButton' => 'Update Post'])

        {!! Form::close() !!}
    </div>

@endsection
