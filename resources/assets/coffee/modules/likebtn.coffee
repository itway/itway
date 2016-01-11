###
  like button functionality
###
$.ItwayIO.likeBTN =
  o:
    formID: $("#like")
    buttonID: $("#like button")
    base_url: $("#like button").attr("data-base-url")
    class_name: $("#like button").attr("data_class_name")
    object_id: $("#like button").attr("data_object_id")
    label: $("#like .label")
    redirectIFerror: APP_URL + "/auth/login"
  activate: () ->
    _this = this
    if _this.o.formID.length != 0
      _this.o.buttonID.on "click", (e) ->
        button = _this.o.buttonID
        buttonI = button.find('i')
        $.ajax {
          type: 'GET'
          url: _this.o.base_url
          data:
            'class_name': _this.o.class_name
            'object_id': _this.o.object_id
          success: (data) ->
            if data == 'error'
              window.location.href = _this.o.redirectIFerror
            if data[0] == 'liked'
              buttonI.addClass 'text-danger'
              buttonI.removeClass 'icon-favorite_outline'
              buttonI.addClass 'icon-favorite'
              _this.o.label.html data[1]
              _this.o.formID.find(".label").after $('<span/>',
                'text': data[2]
                'class': 'like-message')
              $('span .like-message').animate {
                opacity: 0.25
                left: '+=50'
                height: 'toggle'
              }, 200
            else
              buttonI.removeClass 'text-danger'
              buttonI.addClass 'icon-favorite_outline'
              buttonI.removeClass 'icon-favorite'
              _this.o.label.html data[1]
              _this.o.formID.find('.like-message').remove()
            return
          error: (data) ->
            console.log 'error' + '   ' + data
            return
        }, 'html'
        return
    return
$.ItwayIO.likeBTN.activate()