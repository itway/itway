@extends('app')
@section('sitelocation')

    <?php  $name = 'CT'; ?>
    <?php  $msg = "CreateTeam";  ?>

@endsection

@section('navigation.buttons')
    @include('teams.site-btns')
@endsection


@section('content')


    <div class="bg-white" style="">

    {!! Form::model( $teamInstance = new Itway\Models\Team, ['url' => App::getLocale().'/team/store', 'class' => 'ui form', 'id' => 'team-form', 'files' => true ] ) !!}

    @include('teams.team-form', ['submitButton' => 'Create Team', $team=null])

    {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>

@endsection
