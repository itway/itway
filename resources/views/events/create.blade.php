@extends('app')
@section('sitelocation')

    <?php  $name = 'CT'; ?>
    <?php  $msg = "CreateTeam";  ?>

@endsection

@section('navigation.buttons')
    @include('events.site-btns')
@endsection


@section('content')


    <div class="bg-white" style="">

    {!! Form::model( $eventInstance = new Itway\Models\Event(), ['url' => App::getLocale().'/events/store', 'class' => 'ui form', 'id' => 'event-form', 'files' => true ] ) !!}

    @include('events.event-form', ['submitButton' => 'Create Team', $event=null])

    {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>

@endsection
