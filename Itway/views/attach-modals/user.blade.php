<div class="remodal" data-remodal-id="user">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="text-info text-center">
        <i class="icon-person text-primary"></i>

    </div>
    <div id="post-author" class="l-12 m-12 s-12 xs-12 bg-white" style="margin-top:5px; margin-bottom: 10px;">
        <h5>{{trans('post-form.author')}}</h5>

        @include('user.user-partial', [$user = $model->user, $notFromProfile = true])

    </div>
    <br>
</div>
