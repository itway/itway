$.ItwayIO.githubDialog =
o:
  dialog: $("[data-remodal-id='github']")
  button: $("[data-remodal-id='github'] .remodal-confirm")
  input: $("[name='github-link']")
  addonBtn: $("a.github-link")
  timer: undefined
  warningTempl: "<div class=\"text-danger\">The url doesnt match github repo link.</div>"
  formInput: (val) ->
    "<input name='github_link' hidden class='hidden' data-github-id='github-input' value='#{val}'/>"
  dialogTempl:
    "<div class=\"github-input-success input-success \">
    <i class=\"icon-plus_one\"></i>
    </div>"

initialize: ->
  _this = this
  _this.resolveWithTime()
  ### if resolve link is youtube link it returns the link else returns false ###
  github =  $.ItwayIO.cValidator.githubLNK(_this.o.input.val())
  _this.o.button.on 'click', () ->
    if !github && _this.o.input.val().length <= 6
      _this.stop()
      $("[data-github-id='github-input']").attr('value', null)
      _this.resolveAddon()

    else
      _this.o.dialog.find(".text-danger").remove()
      _this.o.dialog.addClass "approved"
      if $("[data-github-id='github-input']").length < 1
        _this.o.addonBtn.after _this.o.formInput(_this.o.input.val())
      else $("[data-github-id='github-input']").attr("value",_this.o.input.val())
      _this.resolveAddon()
  if !github
    _this.o.dialog.removeClass "approved"
    _this.resolveAddon()


resolveWithTime: ->
  _this = this
  _this.o.input.keyup (e) ->
    if (e.keyCode == 13 and $(e.target).val().length > 5 and $.ItwayIO.cValidator.ytVidId(_this.o.input.val())) or ($(e.target).val().length > 5 && $.ItwayIO.cValidator.githubLNK(_this.o.input.val()))
      if _this.o.dialog.find('.github-input-success').length >= 1
        _this.o.dialog.find('.github-input-success').remove()
      _this.o.dialog.find(".text-danger").remove()
      _this.resolve()
    else
      _this.o.dialog.removeClass("approved")
      _this.stop()
      if _this.o.dialog.find(".text-danger").length < 1
        _this.o.dialog.find('.modal-form').after(_this.o.warningTempl)
      _this.o.dialog.find('.github-input-success').remove()
resolve: ->
  _this = this
  run = () ->
    $.ItwayIO.cValidator.githubLNK(_this.o.input.val())
    _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl)
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

$.ItwayIO.githubDialog.initialize()
