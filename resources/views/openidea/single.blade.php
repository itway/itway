@extends('app')
@section('title')
    - {{$openidea->title}}
@endsection
@section('meta-image') @if($openidea->picture()->exists()) @foreach($openidea->picture()->get() as $picture){!! asset('images/openideas/' . $picture->path) !!}@endforeach @else http://www.itway.io/itway-landing.png @endif @endsection
@section('meta-description'){{$openidea->preamble}}@endsection
@section('sitelocation')
    <?php  $name = "TT"; ?>
    <?php  $msg = "Team"; ?>
@endsection
@section('navigation.buttons')
    @include('openideas.site-btns')
@overwrite
@section('content')


    <div class="single-openidea">
        <div class="head">
            <div class="first-line">
                <div class="l-4 m-4 s-4 xs-4">
                    <div class="openidea-author pull-left">
                        <img class="avatar" src="@include('includes.user-image', $user = $openidea->user)" alt=""/>

                        <div class="name"><a href="{{asset(App::getLocale().'/user/'.$openidea->user->id)}}"> {{ $openidea->user->name }} </a></div>
                    </div>
                </div>
                <div class="l-4 m-4 s-4 xs-4 text-center tags">
                                <span class="tags">
                                    @foreach($openidea->tagNames() as $tags)

                                        <a class="tag-name" href="{{url(App::getLocale().'/blog/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>

                                    @endforeach
                                </span>
                </div>
                    @include("includes.like-btn",[$modelName, $model = $openidea])

            </div>
            <div class="header-title">
                <h4 class="text-center"><strong>{{$openidea->title}}</strong></h4>
            </div>

            <div class="time text-center">

                <span class="openidea-time"><i class="icon-clock-o"></i>{{$openidea->published_at->diffForHumans()}}</span>

            </div>
            <div class="l-12 m-12 s-12 xs-12 text-center">
                <nav class="button-nav-openidea button-group-horizontal">
                    <a class="button" href=""><i class="icon-vk text-vk"></i></a>
                    <a class="button" href=""><i class="icon-facebook text-facebook"></i></a>
                    <a class="button" href=""><i class="icon-google text-google"></i></a>
                </nav>
                @if($createdByUser === true)
                    <span class="your-openidea">{{trans('messages.youropenidea')}}</span>
                    <a class="button button-primary" href="{{asset(App::getLocale().'/blog/edit/'.$openidea->id)}}">{{trans('messages.youropenideaBTN')}}</a>
                    <span class="text-muted"> or </span>
                    @include('openideas.destroy')

                @endif
            </div>
        </div>
        <div class="line clearfix"></div>
        <div class="image-area">
            <div class="presc-wrapper">
                @if($openidea->picture()->exists())
                    <div class="l-6 m-6 s-6 xs-10"  style="line-height: 1.875rem;
    padding-top: 0.83333rem;
    padding-bottom: 0.83333rem;">
                        <div class="thumbnail" style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden">
                            @foreach($openidea->picture()->get() as $picture)
                            <img  class="img-responsive" src="{!! asset('images/openideas/' . $picture->path) !!}">
                                @endforeach
                            </div>
                        </div>
                    {{--</div>--}}
                @endif

                @if($openidea->picture()->exists())
                        <div class="prescription l-6 m-6 s-6 xs-10">
                            <h3>
                                <blockquote>
                                    <i></i>
                                    {{$openidea->preamble}}
                                </blockquote>
                            </h3>
                        </div>
                @else
                        <div class="prescription l-12 m-12 s-12 xs-12">
                            <h3>
                                <blockquote>
                                    <i></i>
                                    {{$openidea->preamble}}
                                </blockquote>
                            </h3>
                        </div>
                @endif

            </div>

        </div>
        <div class="clearfix"></div>

        <div class="editormd openidea-text" id="openidea-body">
            <div class="ui active centered large inline loader"></div>
        </div>
        <h3></h3>
        <div class="clearfix"></div>
        <div class="counters l-2 m-2 s-3 xs-3">

        <span class="comments-count"><i class="icon-comment text-grey"></i>
            <a href="{{ url(App::getLocale().'/blog/openidea/'.$openidea->id.'#disqus_thread') }}" data-disqus-identifier="{{$openidea->id}}" >0</a>
        </span>
            <span class="text-left text-primary" style="">
                <i style="text-align: left; margin: 5px;" class="icon-remove_red_eye text-grey"></i>
                <span>{{$openidea->views_count()}}</span>
            </span>
        </div>
   @include('openideas.attached', [$model = $openidea])
    </div>


    <div class="line"></div>

    <div class="row">
        <div class="l-12 m-12">
            <div id="disqus_thread" class="bg-white single-openidea"></div>
            <script type="text/javascript">
                var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
                var disqus_identifier = 'openidea#{{$openidea->id}}';
                var disqus_title = '{{ $openidea->title }}';
                var disqus_url = '{{ url(App::getLocale().'/blog/openidea/'.$openidea->id.'#disqus_thread') }}';

                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        </div>
    </div>
    <script>
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = '//' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());


    </script>
@overwrite
@section('styles-add')
    <link rel="stylesheet" href="{{asset('dist/vendor/editor.md/css/editormd.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/vendor/editor.md/css/editormd.preview.css')}}">

@overwrite
@section('scripts-add')

    <script src="http://www.itway.io/dist/vendor/editor.md/lib/marked.min.js"></script>
    <script src="http://www.itway.io/dist/vendor/editor.md/lib/prettify.min.js"></script>

    <script src="http://www.itway.io/dist/vendor/editor.md/lib/raphael.min.js"></script>
    <script src="http://www.itway.io/dist/vendor/editor.md/lib/underscore.min.js"></script>
    <script src="http://www.itway.io/dist/vendor/editor.md/lib/sequence-diagram.min.js"></script>
    <script src="http://www.itway.io/dist/vendor/editor.md/lib/flowchart.min.js"></script>
    <script src="http://www.itway.io/dist/vendor/editor.md/lib/jquery.flowchart.min.js"></script>
    <script src="{{asset('dist/vendor/editor.md/editormd.min.js')}}"></script>
    @if(App::getLocale() == "en")
        <script src="{{asset('dist/vendor/editor.md/languages/en.js')}}"></script>
    @elseif(App::getLocale() == "ru")
        <script src="{{asset('dist/vendor/editor.md/languages/ru.js')}}"></script>
    @endif
    <script>


        $(function() {
            $.get("{{route('itway::openideas::getPageBody', $openidea->id)}}", function(md){

                testEditor = editormd.markdownToHTML("openidea-body", {
                    markdown        : md['body'] ,//+ "\r\n" + $("#append-test").text(),
                    htmlDecode      : "style,script,iframe",  // you can filter tags decode
                    //toc             : false,
                    tocm            : true,    // Using [TOCM]
                    height:"100%",
                    //gfm             : false,
                    //tocDropdown     : true,
                    // markdownSourceCode : true, // ???? Markdown ????????????? Textarea ??
                    emoji           : true,
                    taskList        : true,
                    tex             : true,  // ?????
                    flowChart       : true,  // ?????
                    sequenceDiagram : true,  // ?????
                });
            }).done(function(e) {
                $("#openidea-body").find(".loader").remove();
            });


        });
    </script>
@overwrite
