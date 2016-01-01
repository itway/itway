<div id="search" class="search">
    <div class="container">
        <button class="close"><i class="icon-close"></i></button>
        {!!Form::open(['method'=>'post','url'=>route('search'), 'class'=> 'l-10 m-10 s-10 xs-10 pull-left','style'=>'text-align:center;padding-bottom: 0;margin-bottom: 0;height: 50px;overflow: hidden;'])!!}
        <input type="search" name="q" class="search-input pull-left" placeholder="Search for...">
        <button type="submit" class="button button-search-apply rounded pull-left"><i class="icon-search"></i></button>
        {!! Form::close() !!}
        <div class="l-2 m-2 s-2 xs-2">
            <li class="tag-line-btn pull-right">
                <a class="button tag-search " href="/"><span
                            class="tags-symbol">#</span> {{ trans('navigation.tag_search') }}</a>
            </li>
        </div>
        <div class="clearfix"></div>
        <div class="container-fluid">
            <div class="search-result" style="">
                <div class="container">
                    <div class="l-9 m-12 s-12 xs-12" id="search-result-body" style="padding-left: 0;">
                        <h1 class="text-center text-warning">search for something ...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
