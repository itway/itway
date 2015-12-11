{{--<div class="search-block ui fullscreen modal scrolling">--}}
    {{--<i class="close icon icon-close"></i>--}}
    {{--<div class="header">--}}
        {{--search for something...--}}
    {{--</div>--}}
    {{--<div class="content">--}}
            {{--{!!Form::open(['method'=>'post','url'=>route('search'),'style'=>'width: 100%; text-align:center'])!!}--}}
            {{--<input type="search"  name="q" class="search-input width100" placeholder="Search for..." >--}}

            {{--<div class="clearfix"></div>--}}

            {{--<li class="tag-line-btn">--}}
                {{--<a class="button button-primary tag-search " href="/"><i class="icon-tags"></i> {{ trans('navigation.tag_search') }}</a>--}}
            {{--</li>--}}
            {{--<button type="submit" class="button  button-lg button-primary rounded"><i class="icon-search"></i> Search</button>--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}

    {{--<div class="clearfix"></div>--}}
    {{--<div class="l-12 m-12 s-12 xs-12">--}}
        {{--<div class="search-result"></div>--}}
    {{--</div>--}}
{{--</div>--}}
<div id="search" class="search">
    <div class="container">
        <button class="close"><i class="icon-close"></i></button>
        {!!Form::open(['method'=>'post','url'=>route('search'), 'class'=> 'l-10 m-10 s-10 xs-10 pull-left','style'=>'text-align:center'])!!}
             <input type="search"  name="q" class="search-input pull-left" placeholder="Search for..." >
        <button type="submit" class="button button-search-apply rounded pull-left"><i class="icon-search"></i> </button>
        {!! Form::close() !!}
        <div class="l-2 m-2 s-2 xs-2">
            <li class="tag-line-btn pull-right">
                <a class="button tag-search " href="/"><span class="tags-symbol">#</span> {{ trans('navigation.tag_search') }}</a>
            </li>
        </div>
        <div class="clearfix"></div>
        <div class="l-9 m-9 s-9 xs-9">
            <div class="search-result"></div>
        </div>
    </div>
</div>
