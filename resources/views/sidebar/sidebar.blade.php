@foreach($sidebar as $modelName => $modelElement)
    @if($modelName == "posts" && count($modelElement) > 0)
        <div class="sidebar-block">
            <h5 class="text-center text-info">{{trans('sidebar.blog')}}</h5>
            @foreach($modelElement as $post)
                <a class="white-bordered" href="{!! route('itway::posts::show', $post->id) !!}">{{$post->title}}
                    <div class="author">author: <small>{{$post->user->name}}</small></div>
                </a>
            @endforeach

        </div>
    @endif
@endforeach