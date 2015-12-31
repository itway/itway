@section('subnav')
    <div class="ui pointing secondary menu nav submenu">
        <div class="container" style="overflow: visible">
            <a class="item {!! Active::pattern(App::getLocale().'/teams', 'active selected') !!} blue"
               href="{{url(App::getLocale().'/teams')}}">
                <i class="icon-grid_on"></i> Teams
            </a>
            @if(!Auth::guest())
                <a class="item {!! Active::pattern(App::getLocale().'/teams/team/create', 'active selected') !!} green"
                   href="{{route('itway::teams::create')}}">
                    <i class="icon-pencil"></i> {{ trans('navigation.Create-Team') }}
                </a>
            @endif
            @if(!Auth::guest())
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
            @endif
            <a class="item {!! Active::pattern(App::getLocale().'/', 'active selected') !!} brown"
               href="{{url(App::getLocale().'/teams')}}"></a>
        </div>
    </div>
@endsection
