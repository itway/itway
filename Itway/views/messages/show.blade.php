@extends('messages.chat-app')

@section('sitelocation')

    <?php  $name = ''; ?>
    <?php  $msg = "";  ?>

@endsection

@section('content')
    <div class="chat l-12 m-12 s-12 xs-12">
        <div class="row">
            @include('messages.chat-buttons')
        </div>
        <div class="row">

            @include('messages.rooms')

            @include('messages.users-block')

    <div class="message-wrap l-9">

        <div class="msg-wrap">
            <div class="ui minimal comments">
                <h3 class="ui dividing header">{!! $thread->subject !!}</h3>
            @foreach($thread->messages as $message)

                <div class="comment" data-comment-user="{!!$message->user->id!!}">
                    <a class="avatar">
                        <img src="@include('includes.user-image', $user = $message->user)" alt="{!! $message->user->name !!}">
                    </a>
                    <div class="content">
                        <a class="author">{!! $message->user->name !!}</a>
                        <div class="metadata">
                            <span class="date"><i class="icon-clock-o"></i> Posted {!! $message->created_at->diffForHumans() !!}</span>
                        </div>
                        <div class="text">
                            {!! $message->body !!}
                        </div>
                        <div class="actions">
                            <a class="reply" data-message="{!! $message->id !!}"><i class="icon-plus"></i> Reply</a>
                        </div>
                    </div>
                </div>

        @endforeach

            </div>

        </div>

        @include('messages.send-form')

    </div>
    </div>
    </div>
@stop
@section("scripts-add")
    <script>

       var current_thread = "{!! $thread->id !!}",
                user_id   = "{!! $userId !!}";

    </script>
   @endsection