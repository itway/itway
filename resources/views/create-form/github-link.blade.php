<div class="remodal" data-remodal-id="github">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>{{trans('post-form.add-github-link')}}</h1>

    <p class="form-group modal-form">
        <i class="icon-github"></i>
        @if($model &&  $model->github_link)
            <input type="text" class="input input-line" name="github-link" value="{{$model->github_link}}"/>
        @else
            <input type="text" class="input input-line" name="github-link"/>
        @endif
    </p>
    <br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>
