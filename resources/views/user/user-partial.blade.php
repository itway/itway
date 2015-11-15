
<div class="xs-12 s-12 m-4 text-center">
    {{--<h4 class="text-primary text-center" style="margin-top: 0">{{trans('profile.user_profile')}}</h4>--}}


    <div class="ui special fluid cards">
        <div class="card">


            @if($user->id === Auth::id())
                @if(!$notFromProfile)

                    @include('user.user-image-update')

                @else
                    <div class="blurring dimmable image">
                        <img  alt="{{$user->name}}" align="center"  title="{{$user->name}}" style="" src="@include('includes.user-image', $user)">
                    </div>
                @endif

            @else
                <img class="profile-img" alt="{{$user->name}}" align="center"  title="{{$user->name}}" style="" src="@include('includes.user-image', $user)">
            @endif

                <div class="content">
                <a class="header" href="{{url(App::getLocale()."/user/".$user->id)}}">{{$user->name}}</a>
                <div class="meta">
                    <span class="date">Joined {{$user->created_at->diffForHumans()}} </span>
                </div>
            </div>
            <div class="extra content">
                <a>
                    <i class="icon-group icon"></i>
                    invite to your team
                </a>
            </div>

        </div>
    </div>

</div>

<div class="user-info-block xs-12 xs-offset-0 s-12 s-offset-0 m-8 m-offset-0">
    <div class="ui cards">

        <div class="card fluid">
            <div class="content">
                <span class="card-header left">{{trans('profile.user_additional')}}</span>
                <div class="user-block ">
                    <span>Slug:  <span class="text-info"> {{$user->slug}}</span> </span>
                    <div class="clearfix"></div>
                    <span>{{trans('profile.user_fullname')}} <span class="text-info"> {{$user->name}} </span> </span>
                    <div class="clearfix"></div>
                    <span>Email: <a href="mailto:{{$user->email}}" target="_top"><span class="text-info"><i class="icon-mail"></i> {{$user->email}}</span></a></span>
                    <div class="clearfix"></div>
                    <span>{{trans('profile.user_last_loggedin')}} <span class="text-info">{{$user->updated_at}}</span></span>
                </div>
            </div>
        </div>
    </div>

    @if(! empty($user->Google) ||  ! empty($user->Facebook) || ! empty($user->Twitter) ||! empty($user->Github))

        <div class="ui cards">

            <div class="card fluid">
                <div class="content">
                    <span class="card-header left">{{trans('profile.user_social')}}</span>
                    <div class="links-user-block">

                        @if(! empty($user->Google))

                            <span class="text-primary">
                        <i class="icon-google text-google"></i>
                                {{$user->Google}}
                    </span>
                            <div class="clearfix"></div>
                        @endif

                        @if(! empty($user->Facebook))

                            <span class="text-primary">
                        <i class="icon-facebook text-facebook"></i>
                                {{$user->Facebook}}
                    </span>
                            <div class="clearfix"></div>
                        @endif


                        @if(! empty($user->Twitter))

                            <span class="text-primary">
                        <i class="icon-twitter text-twitter"></i>
                                {{$user->Twitter}}
                    </span>
                            <div class="clearfix"></div>
                        @endif
                        @if(! empty($user->Github))

                            <span class="text-primary">
                        <i class="icon-github text-github"></i>
                                {{$user->Github}}
                    </span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    @else

        <h4 class="text-warning text-center">{{trans('profile.user_has_noSocial')}}</h4>

    @endif

    <div class="clearfix"></div>


    @if(! empty($user->tagNames()))
        <div class="ui cards">

            <div class="card fluid">
                <div class="content">
                    <div class="card-header left">{{trans('profile.user_skills')}}</div>
                    <div class="description">

                        <div class="user-tags-block">

                            <span class="tags">
                                    @foreach($user->tagNames() as $tags)

                                    <a class="tag-name" href="{{url(App::getLocale().'/user/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>

                                @endforeach
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
            <h4 class="text-warning text-center">{{trans('profile.user_no_skills')}}</h4>
    @endif

@if(! empty($user->bio))
    <div class="row">
        <figure class="bg-white">
            <span class="user-info-title b text-primary text-center">{{trans('profile.user_bio')}}</span>
            <div class="profile-bio">
                <b><i>{{$user->bio}}</i></b>
            </div>

        </figure>
    </div>
@else
    <h4 class="text-warning text-center">{{trans('profile.user_nobio')}} </h4>
@endif
</div>
