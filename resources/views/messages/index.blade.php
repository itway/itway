@extends('messages.chat-app')

@section('sitelocation')

    <?php  $name = ''; ?>
    <?php  $msg = "";  ?>

@overwrite

@section('content')



    @if (Session::has('error_message'))
        <div class="chat l-12 m-12 s-12 xs-12">

            <div class="alert alert-danger" role="alert">
                {!! Session::get('error_message') !!}
            </div>

        </div>
    @endif
    @if($threads->count() > 0)

        @foreach($threads as $thread)
            <div class="chat l-12 m-12 s-12 xs-12" style="margin-bottom: 10px">

                <?php $class = $thread->isUnread($user->id) ? 'alert-info' : ''; ?>
                <a href="{{route("itway::chat.show", $thread->id)}}" class="media alert {!!$class!!}"
                   data-roomId="{{ $thread->id }}">
                    <small class="media-heading"><b> subject: #{!! $thread->subject !!}</b></small>
                    <p>{!! str_limit($thread->latestMessage->body,120) !!}</p>

                    <p class="chat-user-name">
                        <small><strong>Creator:</strong> {!! $thread->creator()->name !!}</small>
                    </p>
                    <p class="chat-user-name">
                        <small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id()) !!}</small>
                    </p>
                </a>
            </div>
            <div class="clearfix"></div>
        @endforeach

    @else

        <div class="chat l-12 m-12 s-12 xs-12">
            <div class="text-center">
                <h3 class="text-warning">Sorry, no conversations.</h3>

                <a id="create-room" class="button button-l button-link text-info text-center"
                   style="text-decoration: underline">#Create a new room</a>

                <div id="no-room">
                    @include('messages.create')
                </div>
            </div>
        </div>

    @endif
@overwrite

