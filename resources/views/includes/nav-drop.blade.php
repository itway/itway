<div class="ui inline dropdown item">
    <div class="text"></div>
    <i class="dropdown icon"></i>
    <div class="menu">
        <a class="item {!! Active::controller('Home', 'active selected') !!} block"
           href="{{ url(App::getLocale().'/') }}"><i
                    class="icon-home"></i> {{trans('navigation.home')}}</a>
        <a class="item block {!! Active::controller("Teams", 'active selected')!!}"
           href="{{route("itway::teams::index")}}"><i
                    class="icon-group text-right"></i> {{ trans('navigation.Teams') }}</a>
        <a class="item {!! Active::controller("Chat", 'active selected')!!} block"
           href="{{route("itway::chat")}}"><i
                    class="icon-chat"></i> {{ trans('navigation.Chat') }}</a>
        <a class="item {!! Active::controller("Events", 'active selected')!!} block"
           href="{{route("itway::events::index")}}"><i
                    class="icon-event text-right"></i> {{ trans('navigation.Event') }}</a>
        <a class="item {!! Active::controller("OpenSourceIdea", 'active selected')!!} block"
           href="{{route("itway::idea-show::index")}}"><i
                    class="icon-graduation-cap"></i> {{ trans('navigation.Idea-Share') }}</a>
        <a class="item {!! Active::controller("Posts", 'active selected')!!} block"
           href="{{route("itway::posts::index")}}"><i
                    class="icon-pencil"></i> {{ trans('navigation.Blog') }}</a>
        <a class="item {!! Active::controller("JobHunting", 'active selected')!!} block"
           href="{{route("itway::job::index")}}"><i
                    class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a>
        {!! Active::controller("Auth\\Auth", '<div class="item active selected block"><i class="icon-user-tie text-right"></i> Auth</div>', [], 'hidden')!!}
        {!! Active::controller("Auth\\Password", '<div class="item active selected block"><i class="icon-lock text-right"></i> Password</div>', [], 'hidden')!!}
        {!! Active::controller("User", '<div class="item active selected block"><i class="icon-settings text-right"></i> User</div>', [], 'hidden')!!}
    </div>
</div>
