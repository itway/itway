<div class="remodal" data-remodal-id="poll">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>
        {{trans('event-form.add-poll')}}
    </h1>
    @include("poll.create")
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>
