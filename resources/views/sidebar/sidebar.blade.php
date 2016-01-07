@foreach($sidebar as $modelName => $modelElement)
    @if($modelName == "posts" && count($modelElement) > 0)
        <div class="sidebar-block">
            <h5 class="text-center text-info">{{trans('sidebar.blog')}}</h5>
            @foreach($modelElement as $post)
                <div class="white-bordered side-item">
                    <a class="" href="{!! route('itway::posts::show', $post->id) !!}">{{$post->title}}</a>
                    @if( !empty($post->getMedia('images')->first()) )
                        <img class="logo" src="{!! url($post->getLogo()) !!}"
                             alt="{{ $post->name }}"/>
                    @endif
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
                    @if( !empty($team->getMedia('logo')->first()) )
                    <img class="logo" src="{!! url($team->getLogo()) !!}"
                         alt="{{ $team->name }}"/>
                    @endif
                    <div class="author">author:
                        <small>
                            <a href="@foreach($team->ownerId() as $ownerId){{url(App::getLocale()."/user/".$ownerId)}}@endforeach">@foreach($team->ownerName() as $owner){{$owner}}@endforeach</a>
                        </small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if($modelName == "events" && count($modelElement) > 0)
        <div class="sidebar-block">
            <h5 class="text-center text-info">{{trans('sidebar.events')}}</h5>
            @foreach($modelElement as $event)
                <div class="white-bordered side-item">
                    <a class="" href="{!!route('itway::events::show', $event->id) !!}"> {{$event->name}}</a>
                    @if( !empty($event->getMedia('images')->first()) )
                        <img class="logo" src="{!! url($event->getImage()) !!}"
                             alt="{{ $event->name }}"/>
                    @endif
                    <div class="author">author:
                        <small>
                            <a href="{{asset(App::getLocale().'/user/'.$event->user->id)}}">{{ $event->user->name }}</a>
                        </small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endforeach