<div class="form-group attach-block">

  <a  class="photo button button-defaut" title="click to attach the photo" href="#photo">
    <i class="icon-insert_photo"></i>
  </a>
  <a class="github-link button button-defaut" title="click to attach github repo link" href="#github">
    <i class="icon-github"></i>
  </a>
  @if($model && $model->github_link)
    <input name="github_link" hidden="" class="hidden" data-github-id="github-input" value="{{$model->github_link}}">
  @endif

  <a class="poll button button-defaut" title="click to attach poll" href="#poll">
    <i class="icon-poll"></i>
  </a>

  <a class="youtube button button-defaut" title="click to attach youtube video link" href="#youtube">
    <i class="icon-youtube"></i>
  </a>
  @if($model && $model->youtube_link)
    <input name="youtube_link" hidden="" class="hidden" data-youtube-id="youtube-input" value="{{$model->youtube_link}}">
  @endif
</div>
