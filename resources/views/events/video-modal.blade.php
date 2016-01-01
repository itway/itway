<div class="remodal" data-remodal-id="youtube">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>
        {{trans('event-form.add-youtube')}}
    </h1>
    <p class="form-group modal-form">
        <i class="icon-youtube"></i>
        @if($model && $model->youtube_link)
            <input type="text" class="input input-line" name="youtube-link"
                   value="https://www.youtube.com/watch?v={{$model->youtube_link}}"/>
        @else
            <input type="text" class="input input-line" name="youtube-link"/>
        @endif
    </p>
    <br>
    <button data-remodal-action="confirm" class="remodal-confirm">Save</button>
</div>
