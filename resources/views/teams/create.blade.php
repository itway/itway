@extends('app')
@section('sitelocation')
    <?php  $name = 'Tm'; ?>
    <?php  $msg = "Team";  ?>
@endsection
@section('content')
    @include('teams.site-btns')

    @include('teams.team-form', ['submitButton' => 'Create Team', $team=null])
@endsection