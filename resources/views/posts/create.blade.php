@extends('app')
@section('sitelocation')

    <?php  $name = 'CP'; ?>
    <?php  $msg = "CreatePost";  ?>

@endsection

@section('navigation.buttons')
    @include('posts.site-btns')
@endsection


@section('content')


    <div class="bg-white" style="  display: flex;">

    {!! Form::model( $postInstance = new Itway\Models\Post, ['url' => App::getLocale().'/blog/store', 'class' => 'form', 'id' => 'post-form', 'files' => true ] ) !!}

    @include('posts.post-form', ['submitButton' => 'Create Post', $post=null])

    {!! Form::close() !!}

    </div>

@endsection
