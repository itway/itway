@section('subnav')
<div class="ui pointing secondary menu nav submenu">
    <div class="container">
        <a class="item selected blue" href="{{url(App::getLocale().'/blog')}}">
            <i class="icon-grid_on"></i> Posts
        </a>
        @if(!Auth::guest())
            <a class="item green" href="{{url(App::getLocale().'/blog/create-post')}}">
                <i class="icon-pencil"></i> {{ trans('navigation.Create-Post') }}
            </a>
        @endif
        @if(!Auth::guest())
            <a class="item red" href="{{url(App::getLocale().'/blog/user-posts')}}">
                <i class="icon-layers"></i> {{ trans('navigation.User-Posts') }}
                <div class="ui red tiny label">{{$countUserPosts}}</div>
            </a>
        @endif
        <a class="item brown" href="{{url(App::getLocale().'/blog/post{id}')}}" >reading post</a>
    </div>
</div>
@endsection