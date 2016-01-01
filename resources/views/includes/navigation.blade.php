<div class="container-fluid nav-main">
<div class="container" style="overflow: visible; padding-top: 0; padding-bottom: 0; margin-bottom: 0; margin-top: 0">
    <div class="l-12 xs-12" style="padding: 0 0">
        <div class="ui small menu">
            <a class="item" href="{{ url('/') }}"><img class="logo" src="{{ url('/itway-landing.png') }}" alt="Itway.io"></a>
            <div class="center item" id="nav">
                @yield('navigation.buttons')
            </div>
            <div class="right menu">
                @include('includes.nav-drop')
                @include('includes.admin-nav-link')
                @if (Auth::guest())
                    @include('includes.language-chooser')
                    <a class="item" href="{{ url('/auth/login') }}">Login</a>
                    <span class="item">/</span>
                    <a class="item" href="{{ url('/auth/register') }}">Register</a>
                @else
                    <a class="ui search-button animate  item"><i class="icon-search"></i> {{trans('navigation.search')}}</a>
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
</div>