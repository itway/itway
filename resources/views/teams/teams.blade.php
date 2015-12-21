{{--ul.teams>li*4>.title+img.team-image+nav.button-nav-team.button-group-vertical>a.button.button-info{share}*4+p.team-text{Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt eos facere quaerat repellat? A ad alias aspernatur cum, dicta in ipsum iusto labore maiores, optio recusandae sed, totam voluptatibus!}+a.read-team.button.button-dark{read-more}--}}

@extends('app')
@section('sitelocation')
    <?php  $name = 'Tm'; ?>
    <?php  $msg = "Team";  ?>
@endsection
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
                                            <span class="title text-grey">team:  </span>
                                            <img class="logo" src="{!! asset('images/teams/' . $team->logo_bg) !!}"
                                                 alt="{{ $team->name }}"/>

                                            <div class="name">
                                                <a href="{{asset(App::getLocale().'/teams/'.$team->id)}}">{{ $team->name }}</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="trend-block">
                                            <span class="title">trends: </span>
                                            @foreach($team->trendNames() as $trend)
                                                <li class="pull-right trend">
                                                    <a class="trend-name"
                                                       href="{{url(App::getLocale().'/trend/'.$trend)}}">
                                            <span>
                                                <b class="text-success">_</b>
                                            </span>{{$trend}}</a>
                                                </li>
                                            @endforeach
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="slot-country">
                                            <span class="title">country: </span>

                                            <div class="country-block">
                                                <i class="{{strtolower($team->country)}} flag"></i>{{$team->country_name}}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="team-owner">
                                            <span class="title">owner:</span>

                                            <div class="team-owner-name">
                                                <a href="@foreach($team->ownerId() as $ownerId){{App::getLocale()."/user/".$ownerId}}@endforeach">@foreach($team->ownerName() as $owner){{$owner}}@endforeach</a>
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
                                       href="{{ url(App::getLocale().'/team/'.$team->id.'#disqus_thread') }}"
                                       data-disqus-identifier="{{$team->id}}">0</a>
                                    <i class="icon-comment"></i>
                                </span>
                                    </nav>
                                    <a class="read-slot button button-dark"
                                       href="{{url(App::getLocale().'/team/'.$team->id)}}">jump
                                        to team</a>
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
@endsection
@endsection