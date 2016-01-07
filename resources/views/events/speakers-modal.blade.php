<div class="remodal" data-remodal-id="speakers">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="form-group modal-form" style="display: block">
        <div class="field">
            <i class="icon-person_add"></i>
            <br>
            <div class="ui horizontal divider">
                <i>{{trans('event-form.add-speakers')}}</i>
            </div>
        </div>
        @if($model && $model->speakers()->exists())
        @else
            <div class="field">
                <div class="ui fluid selection multiple search normal speakersdrop dropdown">
                    <input type="hidden" name="speakers">
                    <i class="dropdown icon"></i>

                    <div class="default text">Select Speakers</div>
                    <div class="menu"></div>
                </div>
            </div>
        @endif
    </div>
    <br>
    <button data-remodal-action="confirm" class="remodal-confirm button">Attach Speakers</button>
</div>
