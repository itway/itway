###
  youtube dialog functionality
###
$.ItwayIO.youtubeDialog =
o:
  dialog: $("[data-remodal-id='youtube']")
  button: $("[data-remodal-id='youtube'] .remodal-confirm")
  input: $("[name='youtube-link']")
  addonBtn: $("a.youtube")
  timer: undefined
  warningTempl: "<div class=\"text-danger\">The url doesnt match youtube video link.</div>"
  formInput: (val) ->
    "<input name='youtube_link' hidden class='hidden' data-youtube-id='youtube-input' value='#{val}'/>"
  dialogTempl: (ytId) ->
    "<div class=\"embed-responsive embed-responsive-16by9\">
    <iframe id='youtubeVideo' src='https://www.youtube.com/embed/#{ytId}' frameborder=\"0\" allowfullscreen></iframe/>
    </div>"

initialize: ->
  _this = this
  if _this.o.dialog.length >=1
    _this.resolveWithTime()
    ### if resolve link is youtube link it returns the link else returns false ###
    ytId =  $.ItwayIO.cValidator.ytVidId(_this.o.input.val())
    _this.o.button.on 'click', () ->
      if !ytId && _this.o.input.val().length <= 6
        _this.stop()
        $("[data-youtube-id='youtube-input']").attr('value', null)
        _this.resolveAddon()

      else
        _this.o.dialog.find(".text-danger").remove()
        _this.o.dialog.addClass "approved"
        if $("[data-youtube-id='youtube-input']").length < 1
          _this.o.addonBtn.after _this.o.formInput($.ItwayIO.cValidator.ytVidId(_this.o.input.val()))
        else $("[data-youtube-id='youtube-input']").attr("value",$.ItwayIO.cValidator.ytVidId(_this.o.input.val()))
        _this.resolveAddon()
    if !ytId
      _this.o.dialog.removeClass "approved"
      _this.resolveAddon()
    else
      _this.o.dialog.addClass "approved"
      _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl(ytId))
      _this.resolveAddon()

resolveWithTime: ->
  _this = this
  _this.o.input.keyup (e) ->
    if (e.keyCode == 13 and $(e.target).val().length > 5 and $.ItwayIO.cValidator.ytVidId(_this.o.input.val())) or ($(e.target).val().length > 5 && $.ItwayIO.cValidator.ytVidId(_this.o.input.val()))
      if _this.o.dialog.find('.embed-responsive-16by9').length >= 1
        _this.o.dialog.find('.embed-responsive-16by9').remove()
      _this.o.dialog.find(".text-danger").remove()
      _this.resolve()
    else
      _this.o.dialog.removeClass("approved")
      _this.stop()
      if _this.o.dialog.find(".text-danger").length < 1
        _this.o.dialog.find('.modal-form').after(_this.o.warningTempl)
      _this.o.dialog.find('.embed-responsive-16by9').remove()
resolve: ->
  _this = this
  run = () ->
    ytId =  $.ItwayIO.cValidator.ytVidId(_this.o.input.val())
    _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl(ytId))
  _this.o.timer = setTimeout(run(), 3000)
stop: ->
  _this = this
  clearTimeout _this.o.timer
resolveAddon: ->
  _this = this
  _this.o.addonBtn.find(".addon").remove()
  if _this.o.dialog.hasClass "approved"
    _this.o.addonBtn.prepend("<span class='addon'><b class='text-danger'>+1</b> added</span>")
  else _this.o.addonBtn.find(".addon").remove()

$.ItwayIO.youtubeDialog.initialize()
