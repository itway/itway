@extends('pages.team')
@section('title')
    - {{$team->title}}
@endsection
@section('meta-image') @if(!empty($team->getLogo())){!! $team->getLogo()!!} @else http://www.itway.io/itway-landing.png @endif @endsection
@section('meta-description'){{$team->preamble}}@endsection
@section('sitelocation')
    <?php  $name = "TT"; ?>
    <?php  $msg = "Team"; ?>
@endsection
@section('navigation.buttons')
    @include('teams.site-btns')
@endsection
@section('content')
    <div class="single-team">
        <div class="head">
            <div class="first-line">
                <div class="l-4 m-4 s-4 xs-4">
                    <div class="team-author pull-left">
                        {{-- <img class="avatar" src="@include('includes.user-image', $user = $team->user)" alt=""/> --}}
                        <div class="name">
                          <a href="@foreach($team->ownerId() as $ownerId){{url(App::getLocale()."/user/".$ownerId)}}@endforeach">@foreach($team->ownerName() as $owner){{$owner}}@endforeach</a>
                        </div>
                    </div>
                </div>
                <div class="l-4 m-4 s-4 xs-4 text-center tags">
                                <span class="tags">
                                    @foreach($team->tagNames() as $tags)
                                        <a class="tag-name" href="{{url(App::getLocale().'/teams/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>
                                    @endforeach
                                </span>
                </div>
                    @include("includes.like-btn",[$modelName="team", $model = $team])
            </div>
            <div class="header-title">
                <h4 class="text-center"><strong>{{$team->title}}</strong></h4>
            </div>
            <div class="time text-center">
                <span class="team-time"><i class="icon-clock-o"></i>{{$team->created_at->diffForHumans()}}</span>
            </div>
            <div class="l-12 m-12 s-12 xs-12 text-center">
                <nav class="button-nav-team button-group-horizontal">
                    <a class="button" href=""><i class="icon-vk text-vk"></i></a>
                    <a class="button" href=""><i class="icon-facebook text-facebook"></i></a>
                    <a class="button" href=""><i class="icon-google text-google"></i></a>
                </nav>
                @if($createdByUser === true)
                    <span class="your-team">{{trans('messages.yourteam')}}</span>
                    <a class="button button-primary" href="{{asset(App::getLocale().'/blog/edit/'.$team->id)}}">{{trans('messages.yourteamBTN')}}</a>
                    <span class="text-muted"> or </span>
                    @include('teams.destroy')
                @endif
            </div>
        </div>
        <div class="line clearfix"></div>
        <div class="image-area">
            <div class="presc-wrapper">
                @if(!empty($team->getLogo()))
                    <div class="l-6 m-6 s-6 xs-10"  style="line-height: 1.875rem;
    padding-top: 0.83333rem;
    padding-bottom: 0.83333rem;">
                        <div class="thumbnail" style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden">
                            <img  class="img-responsive" src="{!! $team->getLogo() !!}">
                            </div>
                        </div>
                @else
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="counters l-2 m-2 s-3 xs-3">
            <span class="text-left text-primary" style="">
                <i style="text-align: left; margin: 5px;" class="icon-remove_red_eye text-grey"></i>
                <span>{{$team->views_count()}}</span>
            </span>
        </div>
     </div>
    <div class="line"></div>

@endsection
@section('styles-add')
@endsection
@section('scripts-add')
    @endsection
