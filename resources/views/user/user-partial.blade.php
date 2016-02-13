<div class="xs-12 s-12 m-4 text-center" style="padding-left: 0">
    <div class="ui special fluid cards">
        <div class="card" style="margin-left: 0">
            @if($user->id === Auth::id())
                @if(!$notFromProfile)
                    @include('user.user-image-update')
                @else
                    <div class="blurring dimmable image">
                        <img alt="{{$user->name}}" align="center" title="{{$user->name}}" style=""
                             src="@include('includes.user-image', $user)">
                    </div>
                @endif
            @else
                <img class="profile-img" alt="{{$user->name}}" align="center" title="{{$user->name}}" style=""
                     src="@include('includes.user-image', $user)">
            @endif
            <div class="content">
                <a class="header" href="{{url(App::getLocale()."/user/".$user->id)}}">{{$user->name}}</a>

                <div class="meta">
                    <span class="date">Joined {{$user->created_at->diffForHumans()}} </span>
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui bottom attached follow button">
                    <i class="icon-group icon"></i>
                    invite to your team
                </a>
            </div>
        </div>
        @if(!empty($user->country))
            <div class="card" style="margin-left: 0">
                <span class="header text-primary text-center">Country:</span>

                <div class="country-block">
                    <i class="{{strtolower($user->country)}} flag"></i>{{$user->country_name}}
                </div>
            </div>
        @endif
        <div class="card" style="margin-left: 0">
        <h6 class="header text-brown" style="">
                        <i style="text-align: left; margin: 5px;" class="icon-remove_red_eye text-grey"></i>
                        views - <span>@if(is_null($user->views_count())) 0 @else
                           $user->views_count()
                        @endif</span>
                    </h6>
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
                        <span>{{trans('profile.user_fullname')}} <span
                                    class="text-info"> {{$user->name}} </span> </span>

                    <div class="clearfix"></div>
                    <span>Email: <a href="mailto:{{$user->email}}" target="_top"><span class="text-info"><i
                                        class="icon-mail"></i> {{$user->email}}</span></a></span>

                    <div class="clearfix"></div>
                    <span>{{trans('profile.user_last_loggedin')}} <span
                                class="text-info">{{$user->updated_at}}</span></span>
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

                            <a href="{{$user->Google}}" target="_blank" class="text-primary">
                                <i class="icon-google text-google"></i>
                                {{$user->Google}}
                            </a>
                            <div class="clearfix"></div>
                        @endif

                        @if(! empty($user->Facebook))

                            <a href="{{$user->Facebook}}" target="_blank" class="text-primary">
                                <i class="icon-facebook text-facebook"></i>
                                {{$user->Facebook}}
                            </a>
                            <div class="clearfix"></div>
                        @endif
                        @if(! empty($user->Twitter))
                            <a href="{{$user->Twitter}}" target="_blank" class="text-primary">
                                <i class="icon-twitter text-twitter"></i>
                                {{$user->Twitter}}
                            </a>
                            <div class="clearfix"></div>
                        @endif
                        @if(! empty($user->Github))
                            <a href="{{$user->Github}}" target="_blank" class="text-primary">
                                <i class="icon-github text-github"></i>
                                {{$user->Github}}
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    @else
        <div class="ui cards">

            <div class="card fluid">
                <div class="content">
                    <h5 class="text-warning text-center">{{trans('profile.user_has_noSocial')}}</h5>
                </div>
            </div>
        </div>
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

                                    <a class="tag-name"
                                       href="{{url(App::getLocale().'/user/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>

                                @endforeach
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="ui cards">

            <div class="card fluid">
                <div class="content">
                    <h5 class="text-warning text-center">{{trans('profile.user_no_skills')}}</h5>
                </div>
            </div>
        </div>
    @endif

    @if(! empty($user->bio))
        <div class="ui cards">

            <div class="card fluid">
                <div class="content">
                    <span class="user-info-title b text-primary text-center">{{trans('profile.user_bio')}}</span>

                    <div class="profile-bio">
                        <b><i>{{$user->bio}}</i></b>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="ui cards">

            <div class="card fluid">
                <div class="content">
                    <h5 class="text-warning text-center">{{trans('profile.user_nobio')}} </h5>
                </div>
            </div>
        </div>
    @endif
</div>
