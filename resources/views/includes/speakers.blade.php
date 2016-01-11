@if(count($speakers) > 0)
<div class="sidebar-block speakers-block">
    <h5 class="text-center text-info"><i class="icon-user-tie"></i> {{trans('sidebar.speakers')}}</h5>
    @foreach($speakers as $speaker)
        <div class="white-bordered side-item">
            <a class="" href="{{url(App::getLocale()."/user/".$speaker->id)}}"> {{$speaker->name}}</a>
            <img class="logo" alt="{{$speaker->name}}" align="center" title="{{$speaker->name}}" style=""
                 src="@include('includes.user-image', $user = $speaker)">

            <div class="clearfix"></div>
            <span class="date">Joined {{$speaker->created_at->diffForHumans()}} </span>

            <div class="ui secondary pointing menu speakers-tab">
                @if(!empty($speaker->country))
                    <a class="item" data-tab="country" title="{{$speaker->name}} country">
                        <i class="icon-location_on icon"></i>
                    </a>
                @endif
                @if(!empty($speaker->bio))
                    <a class="item" data-tab="bio" title="{{$speaker->name}} bio">
                        <i class="icon-briefcase icon"></i>
                    </a>
                @endif
                @if(! empty($speaker->Google) ||  ! empty($speaker->Facebook) || ! empty($speaker->Twitter) ||! empty($speaker->Github))
                    <a class="item" data-tab="socials" title="{{$speaker->name}} socials">
                        <i class="icon-world icon"></i>
                    </a>
                @endif
            </div>
            <div class="clearfix"></div>
            <div class="meta">
                <div class="clearfix"></div>
                @if(!empty($speaker->country))
                    <div class="ui tab segment" data-tab="country">
                        <div class="content">
                            <div class="country-block">
                                <i class="{{strtolower($speaker->country)}} flag"></i>{{$speaker->country_name}}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @endif
                @if(!empty($speaker->bio))
                    <div class="ui tab segment" data-tab="bio">
                    <span class="title header text-primary text-center">
                        <i class="dropdown icon"></i>
                        biography:
                    </span>

                        <div class="content">
                            <div class="bio-block">
                                <p class="text-bio">{{$speaker->bio}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @endif
                @if(! empty($speaker->Google) ||  ! empty($speaker->Facebook) || ! empty($speaker->Twitter) ||! empty($speaker->Github))
                    <div class="ui tab segment" data-tab="socials">
                        <div class="content">
                            <span class="card-header left">{{trans('profile.user_social')}}</span>
                            <div class="links-user-block">
                                @if(! empty($speaker->Google))
                                    <a href="{{$speaker->Google}}" target="_blank" class="text-primary">
                                        <i class="icon-google text-google"></i>
                                        {{$speaker->Google}}
                                    </a>
                                    <div class="clearfix"></div>
                                @endif
                                @if(! empty($speaker->Facebook))
                                    <a href="{{$speaker->Facebook}}" target="_blank" class="text-primary">
                                        <i class="icon-facebook text-facebook"></i>
                                        {{$speaker->Facebook}}
                                    </a>
                                    <div class="clearfix"></div>
                                @endif
                                @if(! empty($speaker->Twitter))
                                    <a href="{{$speaker->Twitter}}" target="_blank" class="text-primary">
                                        <i class="icon-twitter text-twitter"></i>
                                        {{$speaker->Twitter}}
                                    </a>
                                    <div class="clearfix"></div>
                                @endif
                                @if(! empty($speaker->Github))
                                    <a href="{{$speaker->Github}}" target="_blank" class="text-primary">
                                        <i class="icon-github text-github"></i>
                                        {{$speaker->Github}}
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endif