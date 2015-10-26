<div class="ui tab" data-tab="users">
<div class="conversation-wrap l-3" id="users">
    <small class="users-header">People in your team</small>


        @if ( !$users->isEmpty())
            @foreach ($users as $user)
                <a href="#" class="media conversation chat-user-list" data-userId="{{ $user->id }}">
                    <div class="pull-left" >
                        <img class="media-object" alt="{{ $user->name }}" src="@include('includes.user-image', $user)">
                    </div>
                    <div class="media-body">
                        <small class="media-heading ">{{ $user->name }}</small>
                        <small>Hello</small>
                    </div>
                </a>
            @endforeach
        @else
            <p class="text-warning">There are no users</p>
        @endif

</div>
</div>


