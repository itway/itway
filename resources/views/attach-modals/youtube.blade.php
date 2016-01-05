<div class="remodal" data-remodal-id="youtube">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="text-info text-center">
        <i class="icon-youtube text-danger"></i>
        attached video
    </div>
    @include('includes.videos', [$video = $model->youtube_link, isset($multiple) ? $multiple : null])
    <br>
</div>
