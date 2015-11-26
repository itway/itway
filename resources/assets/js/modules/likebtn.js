
/*
  like button functionality
 */

(function() {
  $.ItwayIO.likeBTN = {
    o: {
      formID: $("#like"),
      buttonID: $("#like button"),
      base_url: $("#like button").attr("data-base-url"),
      class_name: $("#like button").attr("data_class_name"),
      object_id: $("#like button").attr("data_object_id"),
      label: $("#like .label"),
      redirectIFerror: "http://www.itway.io/auth/login"
    },
    activate: function() {
      var _this;
      _this = this;
      console.log(_this.o.formID, _this.o.base_url);
      if (_this.o.formID.length !== 0) {
        _this.o.buttonID.on("click", function(e) {
          var button, buttonI;
          button = _this.o.buttonID;
          buttonI = button.find('i');
          $.ajax({
            type: 'GET',
            url: _this.o.base_url,
            data: {
              'class_name': _this.o.class_name,
              'object_id': _this.o.object_id
            },
            success: function(data) {
              if (data === 'error') {
                window.location.href = _this.o.redirectIFerror;
              }
              if (data[0] === 'liked') {
                buttonI.addClass('text-danger');
                buttonI.removeClass('icon-favorite_outline');
                buttonI.addClass('icon-favorite');
                _this.o.label.html(data[1]);
                _this.o.formID.find(".label").after($('<span/>', {
                  'text': data[2],
                  'class': 'like-message'
                }));
                $('span .like-message').animate({
                  opacity: 0.25,
                  left: '+=50',
                  height: 'toggle'
                }, 200);
              } else {
                buttonI.removeClass('text-danger');
                buttonI.addClass('icon-favorite_outline');
                buttonI.removeClass('icon-favorite');
                _this.o.label.html(data[1]);
                _this.o.formID.find('.like-message').remove();
              }
            },
            error: function(data) {
              console.log('error' + '   ' + data);
            }
          }, 'html');
        });
      }
    }
  };

  $.ItwayIO.likeBTN.activate();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/likebtn.js.map
