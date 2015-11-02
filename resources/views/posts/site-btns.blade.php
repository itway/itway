
@if( Route::currentRouteName('blog'))
<a class="item" href="{{ url(App::getLocale().'/blog/create') }}" > {{ trans('navigation.Create-Post') }}</a>
<a class="item" href="{{ url(App::getLocale().'/blog/user-posts') }}" ><i class="icon-archive"></i> {{ trans('navigation.User-Posts') }} <div class="ui teal label">{{$countUserPosts}}</div></a>
@endif


