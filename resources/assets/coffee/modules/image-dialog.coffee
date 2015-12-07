# generate images live rendering
$.ItwayIO.imageDialog =
  o:
    addonBtn: $("a.photo")
    dialog: $("[data-remodal-id='photo']")
    photoBlock: $(".photo-block")
    photoinput: $('#photoUpload').attr('accept', 'image/jpeg,image/png,image/gif')
    fileLabel: $(".filelabel")
    button: $("[data-remodal-id='photo'] .remodal-confirm")
    templateImage: (src, size) ->
      '<img class="" src=\'' + src + '\' />'

  activate: ->
    _this = this
    _this.initiateDialogImage()
    _this.findImageifExists()
    return
  renderDialogImage: (file, fileinput, settings) ->
# generate a new FileReader object
    _this = this
    reader = new FileReader
    image = new Image

    reader.onload = (_file) ->
      image.src = _file.target.result
      # url.createObjectURL(file);

      image.onload = ->
        w = @width
        h = @height
        t = file.type
        n = file.name
        s = ~ ~(file.size / 1024) / 1024
        scaleWidth = settings.thumbnail_size
        _this.o.photoBlock.append _this.o.templateImage image.src, s.toFixed(2)
        _this.renderLabelFileName n, 'success'
        return

      image.onerror = ->
        alert 'Invalid file type: ' + file.type
        _this.renderLabelFileName file.name, "error"
        fileinput.val null
        return

      return

    reader.readAsDataURL file
    return
  findImageifExists: ->
    _this = this
    if _this.o.photoBlock.find("img").length >= 1
      _this.o.fileLabel.addClass 'hasImage'
      _this.o.addonBtn.prepend("<span class='addon'><b class='text-danger'>+1</b> added</span>")
    else
      _this.o.fileLabel.removeClass 'hasImage'
      _this.o.addonBtn.find(".addon").remove()

  resolveAddon: ->
    _this = this
    _this.o.addonBtn.find(".addon").remove()
    if _this.o.dialog.hasClass "approved"
      _this.o.addonBtn.prepend("<span class='addon'><b class='text-danger'>+1</b> added</span>")
    else _this.o.addonBtn.find(".addon").remove()
  renderLabelFileName: (filename, message)->
    _this = this
    fileLabel = $('.filelabel')
    if fileLabel.find("i.text-success").length > 0 || fileLabel.find("i.text-danger").length > 0
      fileLabel.find("i.text-success.icon-expand_more").remove()
      fileLabel.find("i.text-danger").remove()

    if message == "success"
      _this.o.fileLabel.addClass 'hasImage'
    else
      _this.o.fileLabel.removeClass 'hasImage'
      _this.o.fileLabel.append $('<i>').addClass('text-danger').text("format is not valid").css({
        'font-size': '14px'
        'display': 'block'
        'font-weight': 'normal'
        'font-style': 'normal'})
  confirmImage: (input) ->
    _this = this
    _this.o.button.on "click", (e) ->
      if $("[data-photo-id='photo-input']").length < 1
        newInput = input.attr "data-photo-id", "photo-input"
        _this.o.addonBtn.after newInput
      else
        $("[data-photo-id='photo-input']").remove()
        newInput = input.attr "data-photo-id", "photo-input"
        _this.o.addonBtn.after newInput
      _this.o.dialog.addClass "approved"
      _this.resolveAddon()
  initiateDialogImage: ->
    _this = this
    settings =
      thumbnail_size: 460
      thumbnail_bg_color: '#ddd'
      thumbnail_border: '1px solid #fff'
      thumbnail_shadow: '0 0 0px rgba(0, 0, 0, 0.5)'
      label_text: ''
      warning_message: 'Not an image file.'
      warning_text_color: '#f00'
      input_class: 'custom-file-input button button-primary button-block'
    # when the file is read it triggers the onload event above.
    # handle input changes
    _this.o.photoinput.change (e) ->
      _this.o.photoBlock.html ''
      if @disabled
        return alert('File upload not supported!')
      F = @files
      if F and F[0]
        i = 0
        while i < F.length
          if F[i].type.match('image.*')
            _this.renderDialogImage F[i], _this.o.photoinput, settings
            _this.confirmImage $(e.target)
          else
            _this.renderLabelFileName F[i].name, "error"
            _this.o.dialog.removeClass "approved"
          i++
      return
    return


$.ItwayIO.imageDialog.activate()
