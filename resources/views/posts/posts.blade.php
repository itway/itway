<div class="generic-block">
    @include('posts.site-btns')
    @if(count($posts)=== 0 )
        @include('errors.nothing')
    @else
        @include('includes.tag-side', [$tags_title = trans('post.post-tags'), $base = 'blog'])
        <div class="slots l-9 m-9 s-9 xs-9">
            @foreach(array_chunk($posts->getCollection()->all(), 1) as $row)
                <div class="row">
                    @foreach($row as $post)
                        <div class="l-12 m-12 s-12 xs-12">
                            <div class="slot">
                                <div class="slot-author l-6  m-6  s-6 xs-6">
                                    <img class="avatar" src="@include('includes.user-image', $user = $post->user)"
                                         alt=""/>

                                    <div class="name">
                                        <a href="{{asset(App::getLocale().'/user/'.$post->user->id)}}">{{ $post->user->name }}</a>
                                    </div>
                                </div>
                                <div class="tag-block  l-6  m-6  s-6 xs-6">
                                    @foreach($post->tagNames() as $tags)
                                        <li class="pull-right tags">
                                            <a class="tag-name"
                                               href="{{url(App::getLocale().'/blog/tags/'.strtolower($tags))}}"><span>#</span>{{strtolower($tags)}}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                                <div class="slot-title ">{{str_limit($post->title, 120)}}</div>
                                <div class="clearfix"></div>
                                @if(!empty($post->getMedia('images')->first()))
                                    <div class="l-12 m-12 s-12 xs-12">
                                        <div class="col-sm-6 col-md-4"
                                             style="max-height: 450px; min-height: 300px; padding-top: 5px;">
                                            <div class="thumbnail"
                                                 style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden;">
                                                <img class="img-responsive"
                                                     src="{!! $post->getImage() !!}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p style="padding-top: 10px;" class="slot-info">
                                        {{str_limit($post->preamble, 200)}}
                                    </p>
                                @else
                                    <p style="padding-top: 10px;" class="l-12 m-12 s-12 xs-12 slot-info">
                                        {{str_limit($post->preamble, 200)}}
                                    </p>
                                @endif
                                <nav class="button-nav-slot button-group-horizontal  l-12 m-12 s-12 xs-12">
                                    <span class="button">
                                        <span class="text-left text-primary">{{$post->views_count()}}</span><i
                                                class="icon-remove_red_eye"></i></span>
                                    <span class="button">
                                        <a class="text-left text-primary"
                                           href="{{ url(App::getLocale().'/blog/post/'.$post->id.'#disqus_thread') }}"
                                           data-disqus-identifier="{{$post->id}}">0</a>
                                        <i class="icon-comment"></i>
                                    </span>
                                    @if($post->github_link)
                                        <a class="button" target="_blank" href="{{$post->github_link}}"><i
                                                    class="icon-github text-grey"></i></a>
                                    @endif
                                    @if($post->youtube_link)
                                        <a class="button" href="#youtube"><i class="icon-youtube text-danger"></i></a>
                                        @include('attach-modals.youtube', [$model = $post])
                                    @endif
                                </nav>
                                <a class="read-slot button button-dark"
                                   href="{{url(App::getLocale().'/blog/post/'.$post->id)}}">read-more</a>
                                <span class="slot-time pull-left"><i
                                            class="icon-access_time text-warning"></i>{{$post->published_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div style="margin-top: 10px;"></div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        @if($posts->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-wrapper-inner">
                    {!! (new Itway\Models\Pagination($posts))->render() !!}
                </div>
            </div>
        @endif
    @endif
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
</div>