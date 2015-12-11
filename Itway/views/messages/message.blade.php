<div class="comment">
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
            <a class="reply" data-message="{!! $message->id !!}">Reply</a>
        </div>
    </div>
</div>