(function() {
  $.ItwayIO.youtubeDialog = {
    o: {
      dialog: $("[data-remodal-id='youtube']"),
      button: $("[data-remodal-id='youtube'] .remodal-confirm"),
      input: $("[name='youtube-link']"),
      addonBtn: $("a.youtube"),
      timer: void 0,
      warningTempl: "<div class=\"text-danger\">The url doesnt match youtube video link.</div>",
      formInput: function(val) {
        return "<input name='youtube_link' hidden class='hidden' data-youtube-id='youtube-input' value='" + val + "'/>";
      },
      dialogTempl: function(ytId) {
        return "<div class=\"embed-responsive embed-responsive-16by9\"> <iframe id='youtubeVideo' src='https://www.youtube.com/embed/" + ytId + "' frameborder=\"0\" allowfullscreen></iframe/> </div>";
      }
    },
    initialize: function() {
      var _this, ytId;
      _this = this;
      _this.resolveWithTime();

      /* if resolve link is youtube link it returns the link else returns false */
      ytId = $.ItwayIO.cValidator.ytVidId(_this.o.input.val());
      _this.o.button.on('click', function() {
        if (!ytId && _this.o.input.val().length <= 6) {
          _this.stop();
          $("[data-youtube-id='youtube-input']").attr('value', null);
          return _this.resolveAddon();
        } else {
          _this.o.dialog.find(".text-danger").remove();
          _this.o.dialog.addClass("approved");
          if ($("[data-youtube-id='youtube-input']").length < 1) {
            _this.o.addonBtn.after(_this.o.formInput($.ItwayIO.cValidator.ytVidId(_this.o.input.val())));
          } else {
            $("[data-youtube-id='youtube-input']").attr("value", $.ItwayIO.cValidator.ytVidId(_this.o.input.val()));
          }
          return _this.resolveAddon();
        }
      });
      if (!ytId) {
        _this.o.dialog.removeClass("approved");
        return _this.resolveAddon();
      }
    },
    resolveWithTime: function() {
      var _this;
      _this = this;
      return _this.o.input.keyup(function(e) {
        if ((e.keyCode === 13 && $(e.target).val().length > 5 && $.ItwayIO.cValidator.ytVidId(_this.o.input.val())) || ($(e.target).val().length > 5 && $.ItwayIO.cValidator.ytVidId(_this.o.input.val()))) {
          if (_this.o.dialog.find('.embed-responsive-16by9').length >= 1) {
            _this.o.dialog.find('.embed-responsive-16by9').remove();
          }
          _this.o.dialog.find(".text-danger").remove();
          return _this.resolve();
        } else {
          _this.o.dialog.removeClass("approved");
          _this.stop();
          if (_this.o.dialog.find(".text-danger").length < 1) {
            _this.o.dialog.find('.modal-form').after(_this.o.warningTempl);
          }
          return _this.o.dialog.find('.embed-responsive-16by9').remove();
        }
      });
    },
    resolve: function() {
      var _this, run;
      _this = this;
      run = function() {
        var ytId;
        ytId = $.ItwayIO.cValidator.ytVidId(_this.o.input.val());
        return _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl(ytId));
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

  $.ItwayIO.youtubeDialog.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/youtube-dialog.js.map
