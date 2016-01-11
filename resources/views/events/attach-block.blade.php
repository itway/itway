<div class="form-group attach-block">
    <a class="photo button button-defaut" title="click to attach the photo" href="#photo">
        <i class="icon-insert_photo"></i>
    </a>
    @if($model && $model->event_photo)
        <input name="event_photo" hidden="" class="hidden" data-event_photo-id="photo"
               value="{{$model->event_photo}}">
    @endif
    <a class="poll button button-defaut" title="click to attach poll" href="#poll">
        <i class="icon-poll"></i>
    </a>
    <a class="youtube button button-defaut" title="click to attach youtube video link" href="#youtube">
        <i class="icon-youtube"></i>
    </a>
    @if($model && $model->youtube_link)
        <input name="youtube_link" hidden="" class="hidden" data-youtube-id="youtube-input"
               value="{{$model->youtube_link}}">
    @endif
    <a class="speakers button button-defaut" title="click to attach speakers" href="#speakers">
        <i class="icon-person_add"></i>
    </a>

</div>
