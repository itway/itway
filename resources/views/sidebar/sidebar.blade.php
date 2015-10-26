
@foreach($sidebar as $modelName => $modelElement)

    @if($modelName == "posts" && count($modelElement) > 0)
        <div class="sidebar-block">
        <div class="side-title">{{trans('sidebar.blog')}}</div>
        @foreach($modelElement as $post)

                <a href="{!! route('itway::posts::show', $post->id) !!}">{{$post->title}}</a>
            <div class="line"></div>
        @endforeach

        </div>
          @endif
        @if($modelName =="quizzes" && count($modelElement) > 0)

            <div class="sidebar-block">
                <div class="title">{{trans('sidebar.quiz')}}</div>

                @foreach($modelElement as $quiz){
                <a href="{!! route('itway::quizzes::show', $quiz->id) !!}">{{$quiz->name}}</a>
                <div class="line"></div>
                @endforeach

            </div>
            @endif
@endforeach