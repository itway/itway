
/*
  speakers dialog functionality
 */

(function() {
  $.ItwayIO.speakersDialog = {
    o: {
      dialog: $("[data-remodal-id='speakers']"),
      button: $("[data-remodal-id='speakers'] .remodal-confirm"),
      input: $("[name='speakers']"),
      inputSearch: $("speakersdrop  input.search"),
      addonBtn: $("a.speakers"),
      timer: void 0,
      warningTempl: "<div class=\"text-danger\">Speakers Not Attached</div>",
      formInput: function(val) {
        return "<input name='speakers' hidden class='hidden' data-speakers-id='speakers-input' value='" + val + "'/>";
      },
      dialogTempl: "<div class=\"speakers-input-success input-success \"> <i class=\"icon-ok\"></i> </div>"
    },
    initialize: function() {
      var _this, speakers;
      _this = this;
      _this.resolveWithTime();

      /* if resolve link is youtube link it returns the link else returns false */
      speakers = $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val());
      _this.o.button.on('click', function() {
        if (!speakers && _this.o.input.val().length <= 6) {
          _this.stop();
          $("[data-speakers-id='speakers-input']").attr('value', null);
          return _this.resolveAddon();
        } else {
          _this.o.dialog.find(".text-danger").remove();
          _this.o.dialog.addClass("approved");
          if ($("[data-speakers-id='speakers-input']").length < 1) {
            _this.o.addonBtn.after(_this.o.formInput(_this.o.input.val()));
          } else {
            $("[data-speakers-id='speakers-input']").attr("value", _this.o.input.val());
          }
          return _this.resolveAddon();
        }
      });
      if (!speakers) {
        _this.o.dialog.removeClass("approved");
        return _this.resolveAddon();
      } else {
        _this.o.dialog.addClass("approved");
        _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl);
        return _this.resolveAddon();
      }
    },
    resolveWithTime: function() {
      var _this;
      _this = this;
      return _this.o.inputSearch.keyup(function(e) {
        if ((e.keyCode === 13 && $(e.target).val().length >= 2 && $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val())) || ($(e.target).val().length >= 2 && $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val()))) {
          if (_this.o.dialog.find('.speakers-input-success').length >= 1) {
            _this.o.dialog.find('.speakers-input-success').remove();
          }
          _this.o.dialog.find(".text-danger").remove();
          return _this.resolve();
        } else {
          _this.o.dialog.removeClass("approved");
          _this.stop();
          if (_this.o.dialog.find(".text-danger").length < 1) {
            _this.o.dialog.find('.modal-form').after(_this.o.warningTempl);
          }
          return _this.o.dialog.find('.speakers-input-success').remove();
        }
      });
    },
    resolve: function() {
      var _this, run;
      _this = this;
      run = function() {
        $.ItwayIO.cValidator.speakersNotEmpty(_this.o.input.val());
        return _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl);
      };
      return _this.o.timer = setTimeout(run(), 3000);
    },
    stop: function() {
      var _this;
      _this = this;
      return clearTimeout(_this.o.timer);
    },
    resolveAddon: function() {
      var _this;
      _this = this;
      _this.o.addonBtn.find(".addon").remove();
      if (_this.o.dialog.hasClass("approved")) {
        return _this.o.addonBtn.prepend("<span class='addon'><b class='text-danger'>+1</b> added</span>");
      } else {
        return _this.o.addonBtn.find(".addon").remove();
      }
    }
  };

  $.ItwayIO.speakersDialog.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/speakers-dialog.js.map
