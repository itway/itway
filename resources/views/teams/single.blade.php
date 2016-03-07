@extends('pages.team')
@section('title')
    - {{$team->name}}
@endsection
@section('meta-image') @if(!empty($team->getLogo())){!! $team->getLogo()!!} @else http://www.itway.io/itway-landing.png @endif @endsection
@section('meta-description'){{$team->description}}@endsection
@section('sitelocation')
    <?php  $name = "TT"; ?>
    <?php  $msg = "Team"; ?>
@endsection
@section('navigation.buttons')
    @include('teams.site-btns')
@endsection
@section('content')
    <div class="single-team">
        <div class="l-4 m-4 s-6 xs-12">
            <div class="items">
                <div class="item">
                    <div class="ui cards">
                        <div class="card fluid">
                            <div class="content">
                                <div class="team-author pull-left" style="width: 100%;display: inline-block!important;">
                                    <div class="name" style="display: inline-block;width: 100%!important;">
                                        <a class="ui tiny image" style="width: 100%!important;"
                                           href="{{route('itway::teams::show', $team->id)}}">
                                            @if(!empty($team->getLogo()))
                                                <img class="img-responsive"
                                                     style="max-height: 50px!important; margin: 0 auto; padding: inherit;display: block;"
                                                     src="{!! $team->getLogo() !!}">
                                                <div class="clearfix"></div>
                                                <div class="text-center text-info">team - {{$team->name}}</div>
                                            @else
                                            @endif
                                        </a>
                                        @include("teams.team-like",[$modelName="team", $model = $team])
                                        @include("teams.team-views",[$modelName="team", $model = $team])
                                        @include("teams.team-people",[$modelName="team", $model = $team])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div class="description">
                            <div class="ui cards">
                                <div class="card fluid">
                                    <div class="content">
                                        <div class="trend-block" style="width: 100%;display: inline-block!important;">
                                            <span class="title">{{trans('teams.trends')}} </span>

                                            @foreach($team->trends as $trend)
                                                <a class="trend-name"
                                                   href="{{url(App::getLocale().'/trend/'.$trend->trend)}}">
                                                  <span>
                                                      <b>_</b>
                                                  </span>
                                                    {{$trend->trend}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="ui cards">
                                <div class="card fluid">
                                    <div class="content">
                                        <div class="single-team exists-slot">
                                            <div class="trend-block" style="width: 100%;display: inline-block!important;">
                                                <span class="title">techs: </span>
                                    @foreach($team->tagNames() as $tags)
                                        <a class="trend-name" href="{{url(App::getLocale().'/teams/tags/'.$tags)}}"><span>#</span>{{strtolower($tags)}}
                                        </a>
                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui info message">
                <i class="icon-star"></i>
                Team Users
            </div>

            <div class="ui items">
                @foreach($team->getUsers() as $user)

                        <div class="item" style="background: white; padding-top: 4px;border: 1px solid #ddd;">
                            <a class="ui tiny image">
                            <img src="@include('includes.user-image', $user)"
                                 alt="{{ $user->name }}"/>
                            </a>
                            <div class="content">
                                <a class="header" href="{{asset(App::getLocale().'/user/'.$user->id)}}">{{ $user->name }}</a>
                                <div class="description">
                                    <p>@if($user->bio){{str_limit($user->bio, 240)}}@else <small class="text-grey">no bio</small> @endif</p>
                                    <p>@if($user->position){{str_limit($user->position, 60)}}@else <small class="text-grey">no position</small> @endif</p>
                                </div>
                            </div>
                        </div>

                @endforeach
            </div>
            <div class="time text-center" style="padding-top: 10px">
                            <span class="team-time">team created <i
                                        class="icon-access_time text-warning"></i> {{$team->created_at->diffForHumans()}}</span>
            </div>
        </div>

    </div>
@endsection
@section('styles-add')
    <style>
        .ui.cards .card.fluid {
            width: 100% !important;
            padding-bottom: 3px;
            padding-top: 0;
            margin: 0;
            margin-bottom: 15px;
        }
        .ui.items {
             margin: 0em 0;
        }
        .ui.info.message {
            margin: 0em 0;
        }
        .ui.items>.item>.content p {
            margin: 0 0em;
        }
        .ui.items>.item>.content>.description {
            margin-top: 0em;
        }
    </style>
@endsection
@section('scripts-add')
@endsection
