@section('subnav')
    <div class="ui pointing secondary menu nav submenu">
        <div class="container">
            <a class="item {!! Active::pattern(App::getLocale().'/teams', 'active selected') !!} blue" href="{{url(App::getLocale().'/teams')}}">
                <i class="icon-grid_on"></i> Teams
            </a>
            @if(!Auth::guest())
                <a class="item {!! Active::pattern(App::getLocale().'/teams/team/create', 'active selected') !!} green" href="{{route('itway::teams::create')}}">
                    <i class="icon-pencil"></i> {{ trans('navigation.Create-Team') }}
                </a>
            @endif
            @if(!Auth::guest())
                <a class="item {!! Active::pattern(App::getLocale().'/user-teams/*', 'active selected') !!} red" href="{{route('itway::teams::user-teams', Auth::user()->id)}}"><i
                            class="icon-layers"></i> {{ trans('navigation.User-Team') }}
                    <div class="ui blue tiny label"></div>
                </a>
            @endif
            <a class="item {!! Active::pattern(App::getLocale().'/', 'active selected') !!} brown" href="{{url(App::getLocale().'/teams')}}"></a>
        </div>
    </div>
@endsection
