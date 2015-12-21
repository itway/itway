<div class="container-fluid nav-main">
    <div class="l-12 xs-12" style="padding: 0 0">
        <div class="ui blue menu">
            <div class="left menu">
                <div class="ui inline dropdown item">
                    <div class="text"></div>
                    <i class="dropdown icon"></i>

                    <div class="menu">
                        @if(Request::route()->getPrefix() === "/".App::getLocale())
                            <a class="item block active selected" href="{{ url(App::getLocale().'/') }}"><i
                                        class="icon-home"></i> {{ trans('navigation.home') }}</a>
                        @else
                            <a class="item block" href="{{ url(App::getLocale().'/') }}"><i
                                        class="icon-home"></i> {{ trans('navigation.home') }}</a>
                        @endif
                        @if(Request::route()->getPrefix() === App::getLocale()."/teams")
                            <a class="item block active selected" href="{{route("itway::teams::index")}}"><i
                                        class="icon-group text-right"></i> {{ trans('navigation.Teams') }}</a>
                        @else
                            <a class="item block" href="{{route("itway::teams::index")}}"><i
                                        class="icon-group text-right"></i> {{ trans('navigation.Teams') }}</a>
                        @endif
                        @if(Request::route()->getPrefix() === App::getLocale()."/chat")
                            <a class="item block active selected" href="{{route("itway::chat")}}"><i
                                        class="icon-chat"></i> {{ trans('navigation.Chat') }}</a>
                        @else
                            <a class="item block" href="{{route("itway::chat")}}"><i
                                        class="icon-chat"></i> {{ trans('navigation.Chat') }}</a>
                        @endif
                        @if(Request::route()->getPrefix() === App::getLocale()."/events")
                            <a class="item block active selected" href="{{route("itway::events::index")}}"><i
                                        class="icon-group text-right"></i> {{ trans('navigation.Event') }}</a>
                        @else
                            <a class="item block" href="{{route("itway::events::index")}}"><i
                                        class="icon-event text-right"></i> {{ trans('navigation.Event') }}</a>
                        @endif
                        @if(Request::route()->getPrefix() === App::getLocale()."/idea-show")
                            <a class="item block active selected" href="{{route("itway::idea-show::index")}}"><i
                                        class="icon-graduation-cap"></i> {{ trans('navigation.Idea-Share') }}</a>
                        @else
                            <a class="item block" href="{{route("itway::idea-show::index")}}"><i
                                        class="icon-graduation-cap"></i> {{ trans('navigation.Idea-Share') }}</a>
                        @endif
                        @if(Request::route()->getPrefix() === App::getLocale()."/blog")
                            <a class="item block active selected" href="{{route("itway::posts::index")}}"><i
                                        class="icon-pencil"></i> {{ trans('navigation.Blog') }}</a>
                        @else
                            <a class="item block" href="{{route("itway::posts::index")}}"><i
                                        class="icon-pencil"></i> {{ trans('navigation.Blog') }}</a>
                        @endif

                        @if(Request::route()->getPrefix() === App::getLocale()."/job-hunting")
                            <a class="item block active selected" href="{{route("itway::job::index")}}"><i
                                        class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
                        @else
                            <a class="item block" href="{{route("itway::job::index")}}"><i
                                        class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
                        @endif
                    </div>
                </div>
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
                    <ul class="item" id="alertlink">
                        <li>
                            <a href="#"><i class="icon-bell-o"></i> {{trans('navigation.recent')}}</a>
                            <ul class="notify dropdown-wide">
                                <div class="header-notify">
                                    <b>{{trans('navigation.recent')}}</b>
                                </div>
                                <div class="panel">
                                    <li class="activity">
                                        <a class="link" href="http://www.itway.io/en/blog/post/1">
                                            <span class="ui tag tiny label"> post </span>
                                  <span class="link-block">
                                  <span class="title">Что нужно знать начинающему IT-специалисту? Ответ IT HR-ов на IT Global Meetup what to do
                                  </span>
                                  <span class="author">
                                    <span>author:</span> nilsenj
                                  </span>
                                  </span>
                                        </a>
                                    </li>
                                    <li class="activity">
                                        <a class="link" href="http://www.itway.io/en/blog/post/1">
                                            <span class="ui tag tiny label"> post </span>
                                  <span class="link-block">
                                  <span class="title">Что нужно знать начинающему IT-специалисту? Ответ IT HR-ов на IT Global Meetup what to do
                                  </span>
                                  <span class="author">
                                    <span>author:</span> nilsenj
                                  </span>
                                  </span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                    </ul>
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