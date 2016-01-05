@extends('app')
@section('sitelocation')

    <?php  $name = 'CT'; ?>
    <?php  $msg = "CreateTeam";  ?>

@endsection

@section('navigation.buttons')
    @include('openideas.site-btns')
@overwrite
@section('content')


    <div class="bg-white" style="">

    {!! Form::model( $openideaInstance = new Itway\Models\Team, ['url' => App::getLocale().'/openidea/store', 'class' => 'ui form', 'id' => 'openidea-form', 'files' => true ] ) !!}

    @include('openideas.openidea-form', ['submitButton' => 'Create Team', $openidea=null])

    {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>
@overwrite

