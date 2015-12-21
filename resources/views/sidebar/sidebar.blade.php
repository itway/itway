@foreach($sidebar as $modelName => $modelElement)
    @if($modelName == "posts" && count($modelElement) > 0)
        <div class="sidebar-block">
            <h5 class="text-center text-info">{{trans('sidebar.blog')}}</h5>
            @foreach($modelElement as $post)
                <div class="white-bordered side-item">
                    <a class="" href="{!! route('itway::posts::show', $post->id) !!}">{{$post->title}}</a>

                    <div class="author">author:
                        <small><a href="{{url(App::getLocale()."/user/".$post->user->id)}}">{{$post->user->name}}</a>
                        </small>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
    @if($modelName == "teams" && count($modelElement) > 0)
        <div class="sidebar-block">
            <h5 class="text-center text-info">{{trans('sidebar.teams')}}</h5>
            @foreach($modelElement as $team)
                <div class="white-bordered side-item">
                    <a class="" href="{!!route('itway::teams::show', $team->id) !!}"> {{$team->name}}</a>
                    <img class="logo" src="{!! asset('images/teams/' . $team->logo_bg) !!}"
                         alt="{{ $team->name }}"/>
                    <div class="author">author:
                        <small>
                            <a href="@foreach($team->ownerId() as $ownerId){{App::getLocale()."/user/".$ownerId}}@endforeach">@foreach($team->ownerName() as $owner){{$owner}}@endforeach</a>
                        </small>
                    </div>

                </div>
            @endforeach

        </div>
    @endif
@endforeach