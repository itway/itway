
        <a class="item" href="{{ url(App::getLocale().'/user/'.Auth::id()) }}" ><i class="icon-pencil"></i> {{ trans('navigation.Profile') }}</a>
        <a class="item" href="{{ url(App::getLocale().'/user/settings/'.Auth::id()) }}" ><i class="icon-archive"></i> {{ trans('navigation.Settings') }}</a>
