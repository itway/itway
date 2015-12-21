<nav class="navigation" id="navigation" style="    box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);">
    <div class="container">
        <a class="navigation-brand" href="{{ url('/') }}">Itway.io</a>
        <nav class="navbar-left">
            <li>
                <a href="#" class="button-default button-notify" data-toggle="control-sidebar" title="notifier"><i
                            class="icon-bell-o"></i> </a>
            </li>
            <li>
                <a href="#search" class=""><i class="icon-search"></i> search</a>
            </li>
        </nav>
        <ul class="nav" id="nav">
            {!! Form::open(["class"=>"language-chooser pull-right l-2 m-2 s-3 xs-3", "style"=>"padding-right:0 padding-top:0; padding-bottom:0;", "url"=> URL::route('language-chooser'), "method"=>"post"])!!}
            <select name="locale" class="button button-primary hidden" id="locale">
                <option class="button button-primary hidden" value="ru">Russian</option>
                <option class="button button-primary hidden" value="en" {{ Lang::locale() === 'en' ? '' : 'selected'}}>
                    English
                </option>
            </select>

            <button class="button button-primary pull-right"
                    style="margin-bottom: 0; margin-top: 0; padding-bottom: 2px; padding-top: 2px;">
                <i class="icon-language"></i>
                {{ trans('navigation.LangInfo') }}
                {{ Lang::locale() === 'en' ? 'ru' : 'en'}}
            </button>
            <?php
            $uri = $_SERVER['REQUEST_URI'];
            $uri = ltrim($uri, '/');
            ?>
            <input type="text" hidden name="url" value="{{$uri}}">
            {!! Form::close() !!}
            @include('includes.admin-nav-link')
            {{--<li><a href="{{ url(App::getLocale().'/pins') }}" ><i class="icon-bookmark"></i> {{ trans('navigation.Pins') }}</a></li>--}}
            <span class="hidden-s hidden-xs">

                <li><a href="{{ url(App::getLocale().'/blog') }}"><i
                                class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a></li>
                @yield('nav-buttons')
                <li><a href="{{ url(App::getLocale().'/quiz') }}"><i
                                class="icon-list-alt"></i> {{ trans('navigation.Quiz') }}</a></li>
                <li><a href="{{ url(App::getLocale().'/job-hunting') }}"><i
                                class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a></li>
                <li><a href="{{ url(App::getLocale().'/teams') }}"><i
                                class="icon-group text-right"></i> {{ trans('navigation.Teams') }}</a></li>
                <li><a href="{{ url(App::getLocale().'/idea-show') }}"><i
                                class="icon-bank"></i> {{ trans('navigation.Idea-Share') }}</a></li>
                </span>
        </ul>
        @if (Auth::guest())
            <ul class="nav pull-right">
                <li><a href="{{ url('/auth/login') }}">Login</a></li>
                <span class="text-white">/</span>
                <li><a href="{{ url('/auth/register') }}">Register</a></li>
            </ul>
        @else
            <div class="ui floating dropdown button button-dark pull-right">
                <i class="dropdown icon"></i>

                <div class="default text"><img src="@include('includes.user-image', $user = Auth::user())"
                                               class="avatar" alt="{{ Auth::user()->getSlug() }}"/>

                    <div class="drop-text">{{ Auth::user()->name }}</div>
                </div>
                <div class="menu">
                    <div class="item">
                        <li><a href="{{route('itway::user::show',Auth::user()->id)}}"><i
                                        class="icon-user"></i> {{trans('navigation.profile')}}</a></li>
                    </div>
                    <div class="item">
                        <li><a href="{{ url('/auth/logout') }}"><i
                                        class="icon-power-off"></i> {{trans('navigation.logout')}}</a></li>
                    </div>
                </div>
                @endif
            </div>
    </div>
</nav>