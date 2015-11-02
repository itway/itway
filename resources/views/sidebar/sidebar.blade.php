
@foreach($sidebar as $modelName => $modelElement)

    @if($modelName == "posts" && count($modelElement) > 0)
        <div class="sidebar-block">
        <div class="side-title">{{trans('sidebar.blog')}}</div>
        @foreach($modelElement as $post)
                <a href="{!! route('itway::posts::show', $post->id) !!}">{{$post->title}}
                    <div class="author">author: <small>{{$post->user->name}}</small></div>
                </a>
        @endforeach

        </div>
          @endif
        @if($modelName =="quizzes" && count($modelElement) > 0)

            <div class="sidebar-block">
                <div class="side-title">{{trans('sidebar.quiz')}}</div>

                @foreach($modelElement as $quiz)
                <a href="{!! route('itway::quiz::show', $quiz->id) !!}">{{$quiz->name}}
                <div class="author">author: <small>{{$quiz->user->name}}</small></div>
                </a>
                @endforeach

            </div>
            @endif
@endforeach