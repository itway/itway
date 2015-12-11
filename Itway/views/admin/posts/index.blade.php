
@extends('admin/app')
{{--ul.posts>li*4>.title+img.post-image+nav.button-nav-post.button-group-vertical>a.button.button-info{share}*4+p.post-text{Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt eos facere quaerat repellat? A ad alias aspernatur cum, dicta in ipsum iusto labore maiores, optio recusandae sed, totam voluptatibus!}+a.read-post.button.button-dark{read-more}--}}

@section('navigation.buttons')
    @include('posts.site-btns')
@endsection

@if(count($posts)=== 0 )

    @include('errors.nothing')

@else
    @section('content')
        <span class="admin-head-title">
        The number of posts ({!! \Itway\Models\Post::all()->count() !!})
            &middot;
            <b class="pull-right">{!! link_to_route('admin::posts::create', 'Add new post') !!}</b>
    </span>
        <div class="row admin-block">
            <div class="xs-12">
                <div class="block branding">
                    <div class="header">
                        <h3 class="title text-center">The list of posts</h3>
                        <div class="block-tools">
                            <form action="#" method="get" class="input-group" >
                                <input type="text" name="q" class="input input-l inline" placeholder="Search">
                                <button class="button button-group"><i class="icon-search"></i></button>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="content table-responsive no-padding">
                        <table class="table table-hover">
                            <thead style="width: 100%!important;">
                            <th>#</th>
                            <th>Title</th>
                            <th>User's post</th>
                            <th>Comments</th>
                            <th>Views</th>
                            <th>Published</th>
                            <th class="text-right text-info">Actions</th>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{!! $no !!}</td>
                                    <td>{!! $post->title !!}</td>
                                    <td>
                                        <div class="post-author l-6  m-6  s-6 xs-6">
                                            <img class="avatar" src="@include('includes.user-image', $user = $post->user)" alt="{{ $post->user->name }}"/>
                                            <div class="name">
                                                <a href="{{asset(App::getLocale().'/user/'.$post->user->id)}}">{{ $post->user->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="text-left text-primary" href="{{ url(App::getLocale().'/blog/post/'.$post->id.'#disqus_thread') }}" data-disqus-identifier="post#{{$post->id}}" style="padding-right: 10px;">0 </a>
                                        <i  style="text-align: right; margin: -5px;"  class="icon-comment"></i>
                                    </td>
                                    <td>
                                        <span class="text-left text-primary" style="padding-right: 10px;">{{$post->views_count()}}</span><i style="text-align: right; margin: -5px;" class="icon-remove_red_eye"></i></span>
                                    </td>
                                    <td>
                                        <i class="icon-access_time text-warning"></i> {{$post->published_at->diffForHumans()}}
                                    </td>
                                    <td>
                                        <a class="read-post text-default" target="_blank" href="{{url(App::getLocale().'/blog/post/'.$post->id)}}">read-more</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{!! route('admin::posts::edit', $post->id) !!}">change</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="text-warning" href="{!! route('admin::posts::ban', $post->id) !!}"> @if($post->banned === 0) ban @else unban @endif</a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['class' => '', 'style'=>'width:auto;height:auto;display:inline;', 'method' => 'DELETE', 'url' => [route('admin::posts::delete', $post->id)]])!!}
                                        {!! Form::submit('delete', array('class' => 'href text-danger')) !!}
                                        {!! Form::close()!!}
                                    </td>
                                </tr>
                                <?php $no++ ;?>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <div class="text-center">
            {!! (new Itway\Models\Pagination($posts))->render() !!}
        </div>

    @endsection
@endif



@stop
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