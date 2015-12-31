@section('subnav')
    <div class="ui pointing secondary menu nav submenu">
        <div class="container" style="overflow: visible">
            @if(!Auth::guest())
                <a class="item blue {!! Active::pattern(App::getLocale().'/user/'.Auth::id(), 'active selected') !!}"
                   href="{{ url(App::getLocale().'/user/'.Auth::id()) }}"><i
                            class="icon-user-tie"></i> {{ trans('navigation.Profile') }}</a>
                <a class="item green {!! Active::pattern(App::getLocale().'/user/settings/'.Auth::id(), 'active selected') !!}"
                   href="{{ url(App::getLocale().'/user/settings/'.Auth::id()) }}"><i
                            class="icon-cogs"></i> {{ trans('navigation.Settings') }}</a>
                <div class="right menu">
                    @if(isset($currentTeam))
                        <a class="item {!! Active::pattern(App::getLocale().'/teams/team/'.$currentTeam->id, 'active selected') !!} brown"
                           href="{{route('itway::teams::team', $currentTeam->id)}}"><i
                                    class="icon-group"></i> Team: <span class="text-info"> - {{$currentTeam->name}} </span>
                            <img class="avatar" style="margin-left: 10px" src="{!! asset('images/teams/' . $currentTeam->logo_bg) !!}"
                                 alt="{{ $currentTeam->name }}"/>
                        </a>
                    @else
                        <div class="item brown"><i
                                    class="icon-group"></i> Team: <span class="text-brown"> - No team </span>
                        </div>

                    @endif
                    <a class="item {!! Active::pattern(App::getLocale().'/events/user-events', 'active selected') !!} red"
                       href="{{route('itway::events::user-events')}}"><i
                                class="icon-event"></i> {{ trans('navigation.user-event') }}
                        <div class="ui green tiny label">0</div>
                    </a>
                    <a class="item {!! Active::pattern(App::getLocale().'/blog/user-posts', 'active selected') !!} red" href="{{url(App::getLocale().'/blog/user-posts')}}">
                        <i class="icon-pencil"></i> {{ trans('navigation.User-Posts') }}
                        <div class="ui red tiny label">{{$countUserPosts}}</div>
                    </a>
                    @include('includes.language-chooser')
                </div>

            @endif
        </div>
    </div>
@endsection
