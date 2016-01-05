@extends('app')
@section('sitelocation')
    <?php  $name = 'Bl'; ?>
    <?php  $msg = "Blog";  ?>
@overwrite
@section('content')
    <div class="generic-block">
        @include('events.site-btns')
        @if(count($events)=== 0 )
            @include('errors.nothing')
        @else
            @include('includes.tag-side', [$tags, $tags_title = trans("event.event-tags"), $base = 'events'])
            <div class="slots l-9 m-9 s-9 xs-9">
                @foreach(array_chunk($events->getCollection()->all(), 1) as $row)
                    <div class="row">
                        @foreach($row as $event)
                            <div class="l-12 m-12 s-12 xs-12">
                                <div class="slot">
                                    <div class="slot-author l-6  m-6  s-6 xs-6">
                                        <div class="slot-title-event">
                                            {{$event->event_format}}
                                            <i class="icon-event"></i></div>
                                        <img class="avatar" src="@include('includes.user-image', $user = $event->user)"
                                             alt="{{"Publisher: ".$event->user->name}}"/>

                                        <div class="name">
                                            <a href="{{asset(App::getLocale().'/user/'.$event->user->id)}}">{{ $event->user->name }}</a>
                                        </div>
                                    </div>
                                    <div class="tag-block  l-6  m-6  s-6 xs-6">
                                        @foreach($event->tagNames() as $tags)
                                            <li class="pull-right tags">
                                                <a class="tag-name"
                                                   href="{{url(App::getLocale().'/events/tags/'.strtolower($tags))}}"><span>#</span>{{strtolower($tags)}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="slot-title">
                                        <div class="slot-title-name">name:</div>
                                        {{str_limit($event->name, 120)}}</div>
                                    <div class="clearfix"></div>
                                    @if(!empty($event->getMedia('images')->first()))
                                        <div class="l-12 m-12 s-12 xs-12">
                                            <div class="col-sm-6 col-md-4"
                                                 style="max-height: 450px; min-height: 300px; padding-top: 5px;">
                                                <div class="thumbnail"
                                                     style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden;">
                                                    <img class="img-responsive"
                                                         src="{!! url($event->getImage()) !!}"
                                                         alt="{{ $event->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p style="padding-top: 10px;" class="slot-info">
                                            {{str_limit($event->preamble, 200)}}
                                        </p>
                                    @else
                                        <p style="padding-top: 10px;" class="l-12 m-12 s-12 xs-12 slot-info">
                                            {{str_limit($event->preamble, 200)}}
                                        </p>
                                    @endif
                                    <nav class="button-nav-slot button-group-horizontal  l-12 m-12 s-12 xs-12">
                                    <span class="button">
                                        <span class="text-left text-primary">{{$event->views_count()}}</span><i
                                                class="icon-remove_red_eye"></i></span>
                                    <span class="button">
                                        <a class="text-left text-primary"
                                           href="{{ url(App::getLocale().'/events/event/'.$event->id.'#disqus_thread') }}"
                                           data-disqus-identifier="{{$event->id}}">0</a>
                                        <i class="icon-comment"></i>
                                    </span>
                                        @if($event->youtube_link)
                                            <a class="button" href="#youtube"><i
                                                        class="icon-youtube text-danger"></i></a>
                                            @include('attach-modals.youtube', [$model = $event])
                                        @endif
                                    </nav>
                                    <a class="read-slot button button-dark"
                                       href="{{url(App::getLocale().'/events/event/'.$event->id)}}">see event</a>
                                    <li class="slot-time pull-left"><i
                                                class="icon-access_time text-warning"></i>{{$event->created_at->diffForHumans()}}
                                    </li>
                                    <li class="slot-date pull-left"><i
                                                class="icon-calendar text-info"></i> {{$event->date}}</li>
                                    <li class="slot-time pull-left"><i
                                                class="icon-timer text-brown"></i> {{$event->time}}</li>
                                    <li class="slot-timezone pull-left"><i
                                                class="">timezone:</i> {{$event->timezone}}</li>

                                </div>
                            </div>
                            <div style="margin-top: 10px;"></div>
                        @endforeach
                    </div>
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

