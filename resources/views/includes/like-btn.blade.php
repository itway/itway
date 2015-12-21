<div class="l-4 m-4 s-4 xs-4" style=" ">
    <div id="like">
        <?php
        $url = 'likeORdis'
        ?>
        <a class="ui basic info left pointing mini label">
            {{$model->getLikeCount()}}
        </a>
        @if($model->liked(Auth::user()))
            <span class="like-message">{{trans("messages.liked")}}</span>
        @endif
        <button
                data-base-url="{{ route($url, array('class_name' => $modelName, 'object_id' => $model->id))}}"
                data-button-ID=$('#like')
                data_class_name="{{$modelName}}"
                data_object_id="{{$model->id}}"
                style="line-height: 40px;" class=" button button-rounded pull-right  tooltip tooltipstered">
            @if($model->liked(Auth::user()))
                <i class="icon-favorite  text-danger "></i>@else <i class="icon-favorite_outline"></i>
            @endif
        </button>

    </div>
</div>