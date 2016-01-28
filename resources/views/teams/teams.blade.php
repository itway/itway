@extends('app')
@section('sitelocation')
    <?php  $name = 'Tm'; ?>
    <?php  $msg = "Team";  ?>
@overwrite
@section('content')
    @include('teams.site-btns')
    <div class="generic-block">
        @if(count($teams)=== 0 )
            @include('errors.nothing')
        @else
            @include('includes.tag-side', [$tags, $tags_title = trans("teams.team-tags"), $base = 'teams'])
            <div class="slots l-9 m-9 s-9 xs-9">
                @foreach(array_chunk($teams->getCollection()->all(), 1) as $row)
                    <div class="row">
                        @foreach($row as $team)
                            <div class="l-12 m-12 s-12 xs-12">
                                <div class="slot">
                                    <div class="slot-info-block l-6  m-6  s-6 xs-6">
                                        <div class="slot-team">
                                            <span class="title text-grey">{{trans('teams.team')}}  </span>
                                            <img class="logo" src="{!! url($team->getLogo())!!}"
                                                 alt="{{ $team->name }}"/>
                                            <div class="name">
                                                <a href="{{asset(App::getLocale().'/teams/'.$team->id)}}">{{ $team->name }}</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="trend-block">
                                            <span class="title">{{trans('teams.trends')}} </span>

                                              @foreach($team->trendNames() as $trend)
                                                <a class="trend-name"
                                                       href="{{url(App::getLocale().'/trend/'.$trend)}}">
                                                  <span>
                                                      <b>_</b>
                                                  </span>
                                                  {{$trend}}
                                                </a>
                                            @endforeach
                                        </div>
                                     <div class="clearfix"></div>
                                        <div class="slot-country">
                                            <span class="title">{{trans('teams.country')}} </span>

                                            <div class="country-block">
                                                <i class="{{strtolower($team->country)}} flag"></i>{{$team->country_name}}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="team-owner">
                                            <span class="title">{{trans('teams.owner')}} </span>
                                            <div class="team-owner-name">
                                                <a href="@foreach($team->ownerId() as $ownerId){{url(App::getLocale()."/user/".$ownerId)}}@endforeach">@foreach($team->ownerName() as $owner){{$owner}}@endforeach</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag-block l-6  m-6  s-6 xs-12">
                                        @foreach($team->tagNames() as $tags)
                                            <li class="pull-right tags">
                                                <a class="tag-name"
                                                   href="{{url(App::getLocale().'/teams/tags/'.strtolower($tags))}}"><span>#</span>{{strtolower($tags)}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                    <nav class="button-nav-slot button-group-horizontal  l-12 m-12 s-12 xs-12">
                                <span class="button">
                    <span class="text-left text-primary">{{$team->views_count()}}</span><i
                                            class="icon-remove_red_eye"></i></span>
                                <span class="button">
                                    <a class="text-left text-primary"
                                       href="{{ url(App::getLocale().'teams/team/'.$team->id.'#disqus_thread') }}"
                                       data-disqus-identifier="{{$team->id}}">0</a>
                                    <i class="icon-comment"></i>
                                </span>
                                    </nav>
                                    <a class="read-slot button button-dark"
                                       href="{{route('itway::teams::team', $team->id)}}">{{trans('teams.visit')}}</a>
                            <span class="slot-time pull-left"><i
                                        class="icon-access_time text-warning"></i>{{$team->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="margin-top: 10px;"></div>
                @endforeach
            </div>
            <div class="clearfix"></div>
            @if($teams->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination-wrapper-inner">
                        {!! (new Itway\Models\Pagination($teams))->render() !!}
                    </div>
                </div>
            @endif
        @endif
    </div>
@overwrite
@section('scripts-add')
    <script>
        var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script');
            s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>
@overwrite
