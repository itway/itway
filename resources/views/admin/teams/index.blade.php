@extends('admin/app')
@section('navigation.buttons')
    @include('teams.site-btns')
@overwrite
@section('content')
    <div class="row admin-block">
        <div class="xs-12">
            <div class="block branding">
                <div class="header">
                    <h3 class="title text-center"> The number of teams ({!! \Itway\Models\Team::all()->count() !!})
                        &middot;
                        The list of teams
                        <span class="admin-head-title"><b class="pull-right">{!! link_to_route('admin::teams::create', 'Add new team') !!}</b></span>
                    </h3>
                    <div class="block-tools">
                        <form action="#" method="get" class="input-group">
                            <input type="text" name="q" class="input input-l inline" placeholder="Search">
                            <button class="button button-group"><i class="icon-search"></i></button>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="content slot table-responsive no-padding">
                    <table class="table table-hover">
                        <thead style="width: 100%!important;">
                        <th>#</th>
                        <th>Name</th>
                        <th>Team's users</th>
                        <th>Trends</th>
                        <th>Country</th>
                        <th>Owner</th>
                        <th>Views</th>
                        <th>Created</th>
                        <th class="text-right text-info">Actions</th>
                        </thead>
                        <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <td>{!! $no !!}</td>
                                <td>
                                    <div class="slot-team">
                                      <img class="logo" src="{!! url($team->getLogo())!!}"
                                           alt="{{ $team->name }}"/>
                                        <div class="name">
                                            <a href="{{asset(App::getLocale().'/teams/team/'.$team->id)}}">{{ $team->name }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach($team->getUsers() as $user)
                                        <div class="team-author l-6  m-6  s-6 xs-6">
                                            <img class="avatar" src="@include('includes.user-image', $user = $user)"
                                                 alt="{{ $user->name }}"/>
                                            <div class="name">
                                                <a href="{{asset(App::getLocale().'/user/'.$user->id)}}">{{ $user->name }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($team->trendNames() as $trend)
                                        <span class="trend">
                                            <a class="trend-name" href="{{url(App::getLocale().'/teams/trend/'.$trend)}}">
                                            <span><b class="text-success">_</b></span>{{$trend}}</a>
                                        </span>
                                        <div class="clearfix"></div>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="country-block">
                                        <i class="{{strtolower($team->country)}} flag"></i>{{$team->country_name}}
                                    </div>
                                </td>
                                <td>
                                    @foreach($team->getOwner() as $owner)
                                        <a href="{{App::getLocale()."/user/".$owner->id}}">{{$owner->name}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="text-left text-primary"
                                          style="padding-right: 10px;">{{$team->views_count()}}</span><i
                                            style="text-align: right; margin: -5px;"
                                            class="icon-remove_red_eye"></i></span>
                                </td>
                                <td>
                                    <i class="icon-access_time text-warning"></i> {{$team->created_at->diffForHumans()}}
                                </td>
                                <td>
                                    <a class="read-team text-default" target="_blank"
                                       href="{{url(App::getLocale().'/teams/team/'.$team->id)}}">view</a>
                                </td>
                                <td class="text-center">
                                    <a href="{!! route('admin::teams::edit', $team->id) !!}">change</a>
                                </td>
                                <td class="text-center">
                                    <a class="text-warning"
                                       href="{!! route('admin::teams::ban', $team->id) !!}"> @if($team->banned === false)
                                            ban @else unban @endif</a>
                                </td>
                                <td class="text-center">
                                    {!! Form::open(['class' => '', 'style'=>'width:auto;height:auto;display:inline;', 'method' => 'DELETE', 'url' => [route('admin::teams::delete', $team->id)]])!!}
                                    {!! Form::submit('delete', array('class' => 'href text-danger')) !!}
                                    {!! Form::close()!!}
                                </td>
                            </tr>
                            <?php $no++;?>
                        @endforeach
                        </tbody>
                    </table>
                    @if(count($teams)=== 0 )
                        @include('admin.partials.nothing')
                    @endif
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="text-center">
        {!! (new Itway\Models\Pagination($teams))->render() !!}
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
