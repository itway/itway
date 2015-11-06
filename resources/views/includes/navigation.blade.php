
<div class="container-fluid nav-main">

    <div class="l-12 xs-12">
    <div class="ui blue menu">

        <div class="left menu">
            <div class="ui inline dropdown item">

                <div class="text">
                    @if(Request::route()->getPrefix() === App::getLocale()."/user")
                        <i class="icon-user-tie"></i> {{ trans('navigation.user') }}
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/admin")
                        <i class="icon-code"></i> {{ trans('navigation.Admin') }}
                    @endif

                    @if(Request::route()->getPrefix() === "/".App::getLocale())
                        <i class="icon-home"></i> {{ trans('navigation.home') }}
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/blog")
                        <i class="icon-pencil"></i> {{ trans('navigation.Blog') }}
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/quiz")
                        <i class="icon-poll"></i> {{ trans('navigation.Quiz') }}
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/job-hunting")
                        <i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/teams")
                        <i class="icon-group text-right"></i>  {{ trans('navigation.Teams') }}
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/idea-show")
                        <i class="icon-graduation-cap"></i> {{ trans('navigation.Idea-Share') }}
                    @endif
                </div>
                <i class="dropdown icon"></i>
                <div class="menu">
                    @if(Request::route()->getPrefix() === "/".App::getLocale())
                        <a class="item block selected" href="{{ url(App::getLocale().'/') }}" ><i class="icon-home"></i> {{ trans('navigation.home') }}</a>
                    @else
                        <a class="item block" href="{{ url(App::getLocale().'/') }}" ><i class="icon-home"></i> {{ trans('navigation.home') }}</a>
                    @endif
                    @if(Request::route()->getPrefix() === App::getLocale()."/blog")
                        <a class="item block selected" href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil"></i> {{ trans('navigation.Blog') }}</a>
                    @else
                        <a class="item block" href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil"></i> {{ trans('navigation.Blog') }}</a>
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/quiz")
                        <a class="item block selected" href="{{ url(App::getLocale().'/quiz') }}"><i class="icon-poll"></i> {{ trans('navigation.Quiz') }}</a>
                    @else
                        <a class="item block" href="{{ url(App::getLocale().'/quiz') }}"><i class="icon-poll"></i> {{ trans('navigation.Quiz') }}</a>
                    @endif

                    @if(Request::route()->getPrefix() === App::getLocale()."/job-hunting")
                        <a class="item block selected" href="{{ url(App::getLocale().'/job-hunting') }}"><i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
                    @else
                        <a class="item block" href="{{ url(App::getLocale().'/job-hunting') }}"><i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
                    @endif
                    @if(Request::route()->getPrefix() === App::getLocale()."/teams")
                        <a class="item block selected" href="{{ url(App::getLocale().'/teams') }}"><i class="icon-group text-right"></i> {{ trans('navigation.Teams') }}</a>
                    @else

                        <a class="item block" href="{{ url(App::getLocale().'/teams') }}"><i class="icon-group text-right"></i> {{ trans('navigation.Teams') }}</a>
                    @endif
                    @if(Request::route()->getPrefix() === App::getLocale()."/idea-show")
                        <a class="item block selected" href="{{ url(App::getLocale().'/idea-show') }}"><i class="icon-graduation-cap"></i> {{ trans('navigation.Idea-Share') }}</a>
                    @else
                        <a class="item block" href="{{ url(App::getLocale().'/idea-show') }}"><i class="icon-graduation-cap"></i> {{ trans('navigation.Idea-Share') }}</a>
                    @endif

                </div>
            </div>
        </div>


        <div class="center item" id="nav">
            <a class="item" href="{{ url('/') }}"><img src="{{ url('/iw.png') }}" alt="Itway.io"></a>

            @include('includes.admin-nav-link')

            <a class="item"><i class="icon-search"></i> {{trans('navigation.search')}}</a>

            @yield('navigation.buttons')

            <a class="item"><i class="icon-bell-o"></i> {{trans('navigation.recent')}}</a>


            <div class="ui dropdown item">
                {{trans('navigation.more')}}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="icon-edit"></i> Edit Profile</a>
                    @include('includes.language-chooser')
                    <a class="item"><i class="icon-cogs"></i> Account Settings</a>
                </div>
            </div>
        </div>
        <div class="right menu">
        @if (Auth::guest())
            <a class="item" href="{{ url('/auth/login') }}">Login</a>
            <span class="item">/</span>
            <a class="item" href="{{ url('/auth/register') }}">Register</a>

        @else
            <div class="ui dropdown inline top right item">
                <img src="@include('includes.user-image', $user = Auth::user())" class="avatar" alt="{{ Auth::user()->getSlug() }}"/>
                {{ Auth::user()->name }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{route('itway::user::show',Auth::user()->id)}}" ><i class="icon-edit"></i> {{trans('navigation.profile')}}</a>
                    <a class="item" href="{{ url('/auth/logout') }}"><i class="icon-exit_to_app"></i> {{trans('navigation.logout')}}</a>
                </div>
            </div>

        @endif
        </div>
    </div>


</div>

</div>