@section('subnav')
    <div class="ui pointing secondary menu nav submenu">
        <div class="container">
            @if(!Auth::guest())
                <a class="item blue {!! Active::pattern(App::getLocale().'/user/'.Auth::id(), 'active selected') !!}"
                   href="{{ url(App::getLocale().'/user/'.Auth::id()) }}"><i
                            class="icon-user-tie"></i> {{ trans('navigation.Profile') }}</a>
                <a class="item green {!! Active::pattern(App::getLocale().'/user/settings/'.Auth::id(), 'active selected') !!}"
                   href="{{ url(App::getLocale().'/user/settings/'.Auth::id()) }}"><i
                            class="icon-pencil"></i> {{ trans('navigation.Settings') }}</a>
                <div class="right menu">
                    <a class="item {!! Active::pattern(App::getLocale().'/events/user-events', 'active selected') !!} red"
                       href="{{route('itway::events::user-events')}}"><i
                                class="icon-layers"></i> {{ trans('navigation.user-event') }}
                        <div class="ui red tiny label"></div>
                    </a>
                    <a class="item {!! Active::pattern(App::getLocale().'teams/team/*', 'active selected') !!} red" href="{{route('itway::teams::team', $currentTeam->id)}}"><i
                                class="icon-group"></i> Team: <span class="text-info"> - {{$currentTeam->name}} </span>
                    </a>
                    <a class="item {!! Active::pattern(App::getLocale().'/blog/user-posts', 'active selected') !!} red" href="{{url(App::getLocale().'/blog/user-posts')}}">
                        <i class="icon-pencil"></i> {{ trans('navigation.User-Posts') }}
                        <div class="ui red tiny label">{{$countUserPosts}}</div>
                    </a>
                </div>

            @endif
        </div>
    </div>
@endsection
