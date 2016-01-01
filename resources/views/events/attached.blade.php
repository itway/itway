<div class="attached l-10 m-10 s-9 xs-9">
    <ul>
        @if($model->youtube_link)
        <li>
            <a href="#youtube">
                <span class="addon"><b class="text-danger">+1</b>
                    <i class="icon-youtube text-danger"></i> added</span>
            </a>
            @include('attach-modals.youtube', [$model])
        </li>
        @endif
        @if($model->user)
                <li>
                    <a href="#user">
                <span class="addon">
                    <i class="icon-person text-info"></i> author info</span>
                    </a>
                    @include('attach-modals.user', [$model])
                </li>
        @endif
        <li>
        </li>
    </ul>
</div>
