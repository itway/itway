@extends('app')
@section('sitelocation')

    <?php  $name = 'Qz'; ?>
    <?php  $msg = "Quiz";  ?>

@endsection
@section('navigation.buttons')
    @include('Quiz.site-btns')
@endsection
@section('content')


    <div class="bg-white" style="  display: flex;">

        {!! Form::model( $quizInstance = new Itway\Models\Quiz, ['url' => App::getLocale().'/quiz/store', 'class' => 'form', 'id' => 'quiz-form', 'files' => true ] ) !!}

        @include('Quiz.quiz-form', ['submitButton' => 'Create Quiz'])

        {!! Form::close() !!}
    </div>

@endsection