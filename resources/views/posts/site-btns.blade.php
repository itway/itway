@section('subnav')
<div class="ui pointing secondary menu nav submenu">
    <div class="container" style="overflow: visible">
        <a class="item {!! Active::pattern(App::getLocale().'/blog', 'active selected') !!} blue" href="{{url(App::getLocale().'/blog')}}">
            <i class="icon-grid_on"></i> Posts
        </a>
        @if(!Auth::guest())
            <a class="item {!! Active::pattern(App::getLocale().'/blog/create', 'active selected') !!} green" href="{{url(App::getLocale().'/blog/create')}}">
                <i class="icon-pencil"></i> {{ trans('navigation.Create-Post') }}
            </a>
        @endif
        @if(!Auth::guest())
            <a class="item {!! Active::pattern(App::getLocale().'/blog/user-posts', 'active selected') !!} red" href="{{url(App::getLocale().'/blog/user-posts')}}">
                <i class="icon-layers"></i> {{ trans('navigation.User-Posts') }}
                <div class="ui red tiny label">{{$countUserPosts}}</div>
            </a>
        @endif
        <a class="item brown" href="{{url(App::getLocale().'/blog/post{id}')}}" >reading post</a>
    </div>
</div>
@endsection