###
  speakers dialog functionality
###
$.ItwayIO.speakersDialog =
  o:
    dialog: $("[data-remodal-id='speakers']")
    button: $("[data-remodal-id='speakers'] .remodal-confirm")
    input: $("[name='speakers']")
    inputSearch: $("speakersdrop  input.search")
    addonBtn: $("a.speakers")
    timer: undefined
    warningTempl: "<div class=\"text-danger\">Speakers Not Attached</div>"
    formInput: (val) ->
      "<input name='speakers' hidden class='hidden' data-speakers-id='speakers-input' value='#{val}'/>"
    dialogTempl:
      "<div class=\"speakers-input-success input-success \">
      <i class=\"icon-ok\"></i>
      </div>"

  initialize: ->
    _this = this

    _this.resolveWithTime()
    ### if resolve link is youtube link it returns the link else returns false ###
    speakers =  $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val())
    _this.o.button.on 'click', () ->
      if !speakers && _this.o.input.val().length <= 6
        _this.stop()
        $("[data-speakers-id='speakers-input']").attr('value', null)
        _this.resolveAddon()

      else
        _this.o.dialog.find(".text-danger").remove()
        _this.o.dialog.addClass "approved"
        if $("[data-speakers-id='speakers-input']").length < 1
          _this.o.addonBtn.after _this.o.formInput(_this.o.input.val())
        else $("[data-speakers-id='speakers-input']").attr("value",_this.o.input.val())
        _this.resolveAddon()
    if !speakers
      _this.o.dialog.removeClass "approved"
      _this.resolveAddon()
    else
      _this.o.dialog.addClass "approved"
      _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl)
      _this.resolveAddon()

  resolveWithTime: ->
    _this = this
    _this.o.inputSearch.keyup (e) ->
      if (e.keyCode == 13 and $(e.target).val().length >= 2 and $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val())) or ($(e.target).val().length >= 2 && $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val()))
        if _this.o.dialog.find('.speakers-input-success').length >= 1
          _this.o.dialog.find('.speakers-input-success').remove()
        _this.o.dialog.find(".text-danger").remove()
        _this.resolve()
      else
        _this.o.dialog.removeClass("approved")
        _this.stop()
        if _this.o.dialog.find(".text-danger").length < 1
          _this.o.dialog.find('.modal-form').after(_this.o.warningTempl)
        _this.o.dialog.find('.speakers-input-success').remove()
  resolve: ->
    _this = this
    run = () ->
      $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val())
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

$.ItwayIO.speakersDialog.initialize()
