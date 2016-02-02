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
    <div class="l-10 l-offset-1 m-10 m-offset-1 s-12 xs-12">
        <h4 class="ui horizontal divider header">
            @if(!empty($team->getLogo()))
                <div class="logo" style="min-width: 80px">
                    <img class="img-responsive" src="{!! $team->getLogo() !!}">
                </div>
            @else
            @endif
            <small class="text-info">{{$team->name}}</small>
        </h4>
        <div class="ui cards">
            <div class="card fluid">
                <div class="content">
                    <div class="header" style='text-align: center'>
                        @if($createdByUser)
                            @include('teams.destroy')
                            <h4 class="ui horizontal divider header">
                                <small class="text-warning">or</small>
                            </h4>
                            <small class="text-center text-info">
                                delegate ownership by clicking <i class="text-danger icon-lock_open"></i> to  <small class="text-primary">Team Users</small>
                            </small>
                        @endif
                    </div>
                    <div class="single-team exists-slot">
                        <div class="ui six doubling cards">
                            @foreach($team->getUsers() as $user)
                                <div class="card">
                                    <div class="image">
                                        <img src="@include('includes.user-image', $user)"
                                             alt="{{ $user->name }}"/>
                                    </div>
                                    <div class="extra content">
                                        <div class="left floated author text-info">
                                            <button class="button button-default button-small-card"><i class="icon-lock_open"></i></button>
                                        </div>
                                        <div class="right floated author">
                                            <a href="{{asset(App::getLocale().'/user/'.$user->id)}}">{{ $user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="time text-center">
                            <span class="team-time"> created <i
                                        class="icon-access_time text-warning"></i> {{$team->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="ui horizontal divider header">
            <i class="icon text-twitter">#</i>
            Team's tags
        </h4>

        <div class="ui cards">
            <div class="card fluid">
                <div class="content">
                    <div class="single-team exists-slot">
                        <div class="text-center tags">
                                <span class="tags">
                                    @foreach($team->tagNames() as $tags)
                                        <a class="tag-name" href="{{url(App::getLocale().'/teams/tags/'.$tags)}}"><span>#</span>{{$tags}}
                                        </a>
                                    @endforeach
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui cards">
            <div class="card fluid">
                <div class="content">
                    <div class="single-team exists-slot counters text-center">
                    <span class="text-brown" style="">
                        <i style="text-align: left; margin: 5px;" class="icon-remove_red_eye text-grey"></i>
                        views - <span>{{$team->views_count()}}</span>
                    </span>
                        <div class="ui horizontal divider">&</div>
                        <span class="text-success">
                             <i class="icon-favorite  text-danger "></i> likes - <span>{{$team->getLikeCount()}}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles-add')
@endsection
@section('scripts-add')
@endsection
