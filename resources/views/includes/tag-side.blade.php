<div class="l-3 m-3 s-3 xs-3">
            <span class="tag-side">
            <h5 class="text-center text-info">{{$tags_title}}</h5>
                @foreach($tags as $tag)
                    <h5>
                    <div class="tag-line">
                        <a class="tag-name white-bordered" href="{{url(App::getLocale().'/'.$base.'/tags',$tag->slug)}}"><span>#</span>{{$tag->slug}} <span class="text-white">|</span> <span class="text-warning">{{$tag->count}}</span></a>
                    </div>
                    </h5>
                @endforeach
        </span>
</div>