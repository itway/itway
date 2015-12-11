@extends('app')
@section('sitelocation')

    <?php  $name = 'Qz'; ?>
    <?php  $msg = "Quiz";  ?>

@endsection

@section('navigation.buttons')
    @include('poll.site-btns')
@endsection

@section('content')

    @if(count($polls)=== 0 )

        @include('errors.nothing')

    @else
        <div class="posts">
            @foreach(array_chunk($polls->getCollection()->all(), 2) as $row)
                <div class="row" >
                    @foreach($row as $poll)
                        <div class="l-6 m-6 s-12 xs-12">

                            <div class="quiz">
                                <div class="quiz-author l-6  m-6  s-6 xs-6">
                                    <img class="avatar" src="@include('includes.user-image', $user = $poll->user)" alt=""/>
                                    <div class="name">
                                        <a href="{{asset(App::getLocale().'/user/'.$poll->user->id)}}">{{ $poll->user->name }}</a>
                                    </div>
                                </div>

                                <div class="tag-block  l-6  m-6  s-6 xs-6">
                                    @foreach($poll->tagNames() as $tags)
                                        <li class="pull-right tags">
                                            <a class="tag-name" href="{{url(App::getLocale().'/blog/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>
                                        </li>
                                    @endforeach
                                </div>
                                <div style="display: none;">
                                    @include('poll.destroy')
                                </div>
                                <div class="clearfix"></div>

                                <div class="post-title ">{{str_limit($poll->title, 120)}}</div>
                                <div class="clearfix"></div>

                                <div class="l-11 m-11 s-10 xs-10">
                                    @if($poll->picture())
                                        <div class="col-sm-6 col-md-4" style="max-height: 450px; min-height: 300px; padding-top: 5px;">
                                            @foreach($poll->picture()->get() as $picture)
                                                <div class="thumbnail" style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden;">
                                                    <img  class="img-responsive" src="{!! asset('images/posts/' . $picture->path) !!}">
                                                </div>
                                            @endforeach
                                        </div>


                                    @endif

                                </div>
                                <nav class="button-nav-post button-group-vertical  l-1 m-1 s-2 xs-2">
                                    <span class="button">
                                        <span class="text-left text-primary" style="position: absolute;left: -10px;">{{$poll->views_count()}}</span><i style="text-align: right; margin: -5px;" class="icon-eye"></i></span>
                                    <span class="button">
                                        <a class="text-left text-primary" href="{{ url(App::getLocale().'/quiz/'.$poll->id.'#disqus_thread') }}" data-disqus-identifier="{{$poll->id}}" style="position: absolute;left: -10px;">0</a>
                                        <i  style="text-align: right; margin: -5px;"  class="icon-comment"></i>
                                    </span>
                                    <a class="button" href=""><i class="icon-facebook text-facebook"></i></a>
                                    <a class="button" href=""><i class="icon-google text-google"></i></a>
                                    <a class="button" href=""><i class="icon-bookmark text-grey"></i></a>
                                </nav>
                                <div class="clearfix"></div>
                                <p style="padding-top: 10px;" class="post-info">{{str_limit($poll->preamble, 200)}}</p>

                                <a class="read-post button button-dark" href="{{url(App::getLocale().'/blog/post/'.$poll->id)}}">read-more</a>
                                <span class="post-time pull-left"><i class="icon-clock-o text-warning"></i>{{$poll->published_at->diffForHumans()}}</span>
                            </div>

                        </div>
                    @endforeach

                </div>
                <div style="margin-top: 10px;"></div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        @if($pollzes->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-wrapper-inner">
                    {!! (new Itway\Models\Pagination($polls))->render() !!}

                </div>
            </div>
        @endif

    @endif
    @endsection
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

