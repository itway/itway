@if( Route::currentRouteName('blog'))
<a class="item" href="{{ url(App::getLocale().'/blog/create') }}" > <i class="icon-pencil"></i> {{ trans('navigation.Create-Post') }}</a>
<a class="item" href="{{ url(App::getLocale().'/blog/user-posts') }}" ><i class="icon-layers"></i> {{ trans('navigation.User-Posts') }} <div class="ui blue tiny label">{{$countUserPosts}}</div></a>
@endif
