<div class="container-fluid site-buttons">


    <div class="ui grey pointing menu subnav-block">

        <div class="ui inline dropdown pull-left l-2 m-2 s-3 xs-3">

            <div class="text">
                @if(Request::route()->getPrefix() === App::getLocale()."/blog")
                   <i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}
                @endif

                @if(Request::route()->getPrefix() === App::getLocale()."/quiz")
                    <i class="icon-list-alt"></i> {{ trans('navigation.Quiz') }}
                @endif

                @if(Request::route()->getPrefix() === App::getLocale()."/job-hunting")
                   <i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}
                @endif

                @if(Request::route()->getPrefix() === App::getLocale()."/teams")
                    <i class="icon-group text-right"></i>  {{ trans('navigation.Teams') }}
                @endif

                @if(Request::route()->getPrefix() === App::getLocale()."/idea-show")
                   <i class="icon-bank"></i> {{ trans('navigation.Idea-Share') }}
                @endif
            </div>
            <i class="dropdown icon"></i>
            <div class="menu">

                @if(Request::route()->getPrefix() === App::getLocale()."/blog")
                    <a class="item block selected" href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a>
                @else
                    <a class="item block" href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a>
                @endif

                @if(Request::route()->getPrefix() === App::getLocale()."/quiz")
                    <a class="item block selected" href="{{ url(App::getLocale().'/quiz') }}"><i class="icon-list-alt"></i> {{ trans('navigation.Quiz') }}</a>
                @else
                    <a class="item block" href="{{ url(App::getLocale().'/quiz') }}"><i class="icon-list-alt"></i> {{ trans('navigation.Quiz') }}</a>
                @endif

                @if(Request::route()->getPrefix() === App::getLocale()."/job-hunting")
                    <a class="item block selected" href="{{ url(App::getLocale().'/job-hunting') }}"><i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
                @else
                    <a class="item block" href="{{ url(App::getLocale().'/job-hunting') }}"><i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
                @endif
                @if(Request::route()->getPrefix() === App::getLocale()."/teams")
                        <a class="item block selected" href="{{ url(App::getLocale().'/teams') }}"><i class="icon-group text-right"></i>  {{ trans('navigation.Teams') }}</a>
                    @else

                    <a class="item block" href="{{ url(App::getLocale().'/teams') }}"><i class="icon-group text-right"></i>  {{ trans('navigation.Teams') }}</a>
                @endif
                @if(Request::route()->getPrefix() === App::getLocale()."/idea-show")
                    <a class="item block selected" href="{{ url(App::getLocale().'/idea-show') }}"><i class="icon-bank"></i> {{ trans('navigation.Idea-Share') }}</a>
                    @else
                    <a class="item block" href="{{ url(App::getLocale().'/idea-show') }}"><i class="icon-bank"></i> {{ trans('navigation.Idea-Share') }}</a>
                @endif
            </div>
        </div>


        <div class="text-center l-8 m-8 s-6 xs-6 inline-block">
            <a class="item" style=" height: 40px;" href="{{ url('/') }}"><img style="padding-top: 9px" src="{{ url('/iw.png') }}" alt="Itway.io"></a>

            @include('includes.admin-nav-link')

            <a href="#search" class="item"><i class="icon-search"></i> search</a>

            @yield('subnavigation.buttons')

            <a class="item"><i class="icon-bell-o"></i> Recent activity</a>


            <div class="ui dropdown item">
                More
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="icon-edit"></i> Edit Profile</a>
                    <a class="item"><i class="icon-globe"></i> Choose Language</a>
                    <a class="item"><i class="icon-cogs"></i> Account Settings</a>
                </div>
            </div>
        </div>
        @include('includes.language-chooser')
        @if (Auth::guest())
            <a class="item" href="{{ url('/auth/login') }}">Login</a>
            <span class="text-white">/</span>
            <a class="item" href="{{ url('/auth/register') }}">Register</a>

        @else
            <a class="item user-img">
                <img src="@include('includes.user-image', $user = Auth::user())" class="avatar" alt="{{ Auth::user()->getSlug() }}"/>
            </a>
            <div class="ui dropdown pointing top right item">
                {{ Auth::user()->name }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{route('itway::user::show',Auth::user()->id)}}" ><i class="icon-user"></i> {{trans('navigation.profile')}}</a>
                    <a class="item" href="{{ url('/auth/logout') }}"><i class="icon-power-off"></i> {{trans('navigation.logout')}}</a>
                </div>
            </div>

        @endif
    </div>


</div>

