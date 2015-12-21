@section('subnav')
    <div class="ui pointing secondary menu nav submenu">
        <div class="container">
            <a class="item selected blue" href="{{url(App::getLocale().'/teams')}}">
                <i class="icon-grid_on"></i> Teams
            </a>
            @if(!Auth::guest())
                <a class="item" href="{{ url(App::getLocale().'/teams/') }}"><i
                            class="icon-layers"></i> {{ trans('navigation.User-Team') }}
                    <div class="ui blue tiny label"></div>
                </a>
            @endif
            @if(!Auth::guest())
                <a class="item" id="create-instance" data-instance="team" href="#create-team">
                    <i class="icon-pencil"></i> {{ trans('navigation.Create-Team') }}
                </a>
            @endif
            <a class="item brown" href="{{url(App::getLocale().'/teams/id')}}">reading post</a>
        </div>
    </div>
@endsection

@include('create-form.teamCreate-modal', [$model = isset($team) ? $team : null])
