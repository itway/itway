<div class="container-fluid nav-main">
    <div class="l-12 xs-12" style="padding: 0 0">
        <div class="ui small menu">
            <div class="left menu">
                @include('includes.nav-drop')
            </div>
            <div class="center item" id="nav">
                <a class="item" href="{{ url('/') }}"><img src="{{ url('/iw.png') }}" alt="Itway.io"></a>
                @include('includes.admin-nav-link')
                <a class="ui search-button animate  item"><i class="icon-search"></i> {{trans('navigation.search')}}</a>
                @yield('navigation.buttons')
                <div class="ui dropdown item">
                    <i class="icon-location_history"></i> {{trans('navigation.LangInfo')}}
                    <i class="dropdown icon"></i>

                    <div class="menu">
                        @include('includes.language-chooser')
                    </div>
                </div>
            </div>
            <div class="right menu">
                @if (Auth::guest())
                    <a class="item" href="{{ url('/auth/login') }}">Login</a>
                    <span class="item">/</span>
                    <a class="item" href="{{ url('/auth/register') }}">Register</a>
                @else
                    @include('includes.nav-notify')
                    <div class="ui dropdown inline top right item">
                        <img src="@include('includes.user-image', $user = Auth::user())" class="avatar"
                             alt="{{ Auth::user()->getSlug() }}"/>
                        {{ Auth::user()->name }}
                        <i class="dropdown icon"></i>

                        <div class="menu">
                            <a class="item" href="{{route('itway::user::show',Auth::user()->id)}}"><i
                                        class="icon-edit"></i> {{trans('navigation.profile')}}</a>
                            <a class="item" href="{{ url('/auth/logout') }}"><i
                                        class="icon-exit_to_app"></i> {{trans('navigation.logout')}}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>