@extends('app')
@section('sitelocation')
    <?php  $name = 'Tm'; ?>
    <?php  $msg = "Team";  ?>
@endsection
@section('content')
@section('navigation.buttons')
    @include('events.site-btns')
@endsection
@if(count($events)=== 0 )
@include('errors.nothing')
@else
  @include('includes.tag-side', [$tags, $tags_title = trans("event.event-tags")])
    <div class="slots l-9 m-9 s-9 xs-9">
            @foreach(array_chunk($events->getCollection()->all(), 1) as $row)
                <div class="row" >
                    @foreach($row as $event)
                    <div class="l-12 m-12 s-12 xs-12">
                        <div class="slot">
                            <div class="slot-info-block l-6  m-6  s-6 xs-6">
                                <div class="slot-event">
                                <span class="title text-grey">event:  </span>
                                <img class="logo" src="{!! asset('images/events/' . $event->logo_bg) !!}" alt="{{ $event->name }}"/>
                                <div class="name">
                                    <a href="{{asset(App::getLocale().'/events/'.$event->id)}}">{{ $event->name }}</a>
                                </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="trend-block">
                                <span class="title">trends: </span>
                                @foreach($event->trendNames() as $trend)
                                    <li class="pull-right trend">
                                        <a class="trend-name" href="{{url(App::getLocale().'/trend/'.$trend)}}">
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
                                    <i class="{{strtolower($event->country)}} flag"></i>{{$event->country_name}}
                                </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="event-owner">
                                    <span class="title">owner:</span>
                                    <div class="event-owner-name">
                                        <a href="@foreach($event->ownerId() as $ownerId){{App::getLocale()."/user/".$ownerId}}@endforeach">@foreach($event->ownerName() as $owner){{$owner}}@endforeach</a>
                                    </div>
                                </div>
                                </div>
                            <div class="tag-block l-6  m-6  s-6 xs-12">
                                @foreach($event->tagNames() as $tags)
                                    <li class="pull-right tags">
                                        <a class="tag-name" href="{{url(App::getLocale().'/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>
                                    </li>
                                @endforeach
                            </div>
                            <div class="clearfix"></div>
                            <nav class="button-nav-slot button-group-horizontal  l-12 m-12 s-12 xs-12">
                                <span class="button">
                    <span class="text-left text-primary">{{$event->views_count()}}</span><i class="icon-remove_red_eye"></i></span>
                                <span class="button">
                                    <a class="text-left text-primary" href="{{ url(App::getLocale().'/event/'.$event->id.'#disqus_thread') }}" data-disqus-identifier="{{$event->id}}">0</a>
                                    <i  class="icon-comment"></i>
                                </span>
                    </nav>
                    <a class="read-slot button button-dark" href="{{url(App::getLocale().'/event/'.$event->id)}}">jump to event</a>
                    <span class="slot-time pull-left"><i class="icon-access_time text-warning"></i>{{$event->created_at->diffForHumans()}}</span>
                </div>
    </div>
  @endforeach
                </div>
            <div style="margin-top: 10px;"></div>
            @endforeach
        </div>
<div class="clearfix"></div>
@if($events->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-wrapper-inner">
            {!! (new Itway\Models\Pagination($events))->render() !!}
        </div>
    </div>
@endif
    @endif
@section('scripts-add')
    <script>
        var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>
    @endsection
@endsection


@stop
