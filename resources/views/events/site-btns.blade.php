@section('subnav')
    <div class="ui pointing secondary menu nav submenu">
        <div class="container" style="overflow: visible">
            <a class="item {!! Active::pattern(App::getLocale().'/events', 'active selected') !!} blue" href="{{url(App::getLocale().'/events')}}">
                <i class="icon-grid_on"></i> {{ trans('navigation.events') }}
            </a>
            @if(!Auth::guest())
                <a class="item {!! Active::pattern(App::getLocale().'/events/create', 'active selected') !!} green" href="{{route('itway::events::create')}}">
                    <i class="icon-pencil"></i> {{ trans('navigation.create-event') }}
                </a>
            @endif
            @if(!Auth::guest())
                <a class="item {!! Active::pattern(App::getLocale().'/events/user-events', 'active selected') !!} red"
                   href="{{route('itway::events::user-events')}}"><i
                            class="icon-event"></i> {{ trans('navigation.user-event') }}
                    <div class="ui red tiny label">
                        @if(isset($countUserEvents))
                            {{$countUserEvents}}
                            @endif
                    </div>
                </a>
            @endif
            <a class="item {!! Active::pattern(App::getLocale().'/', 'active selected') !!} brown" href="{{url(App::getLocale().'/teams')}}"></a>
        </div>
    </div>
@endsection
