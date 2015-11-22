(function() {
  $.ItwayIO.githubDialog = {
    o: {
      dialog: $("[data-remodal-id='github']"),
      button: $("[data-remodal-id='github'] .remodal-confirm"),
      input: $("[name='github-link']"),
      addonBtn: $("a.github-link"),
      timer: void 0,
      warningTempl: "<div class=\"text-danger\">The url doesnt match github repo link.</div>",
      formInput: function(val) {
        return "<input name='github_link' hidden class='hidden' data-github-id='github-input' value='" + val + "'/>";
      },
      dialogTempl: "<div class=\"github-input-success input-success \"> <i class=\"icon-plus_one\"></i> </div>"
    },
    initialize: function() {
      var _this, github;
      _this = this;
      _this.resolveWithTime();

      /* if resolve link is youtube link it returns the link else returns false */
      github = $.ItwayIO.cValidator.githubLNK(_this.o.input.val());
      _this.o.button.on('click', function() {
        if (!github && _this.o.input.val().length <= 6) {
          _this.stop();
          $("[data-github-id='github-input']").attr('value', null);
          return _this.resolveAddon();
        } else {
          _this.o.dialog.find(".text-danger").remove();
          _this.o.dialog.addClass("approved");
          if ($("[data-github-id='github-input']").length < 1) {
            _this.o.addonBtn.after(_this.o.formInput(_this.o.input.val()));
          } else {
            $("[data-github-id='github-input']").attr("value", _this.o.input.val());
          }
          return _this.resolveAddon();
        }
      });
      if (!github) {
        _this.o.dialog.removeClass("approved");
        return _this.resolveAddon();
      }
    },
    resolveWithTime: function() {
      var _this;
      _this = this;
      return _this.o.input.keyup(function(e) {
        if ((e.keyCode === 13 && $(e.target).val().length > 5 && $.ItwayIO.cValidator.ytVidId(_this.o.input.val())) || ($(e.target).val().length > 5 && $.ItwayIO.cValidator.githubLNK(_this.o.input.val()))) {
          if (_this.o.dialog.find('.github-input-success').length >= 1) {
            _this.o.dialog.find('.github-input-success').remove();
          }
          _this.o.dialog.find(".text-danger").remove();
          return _this.resolve();
        } else {
          _this.o.dialog.removeClass("approved");
          _this.stop();
          if (_this.o.dialog.find(".text-danger").length < 1) {
            _this.o.dialog.find('.modal-form').after(_this.o.warningTempl);
          }
          return _this.o.dialog.find('.github-input-success').remove();
        }
      });
    },
    resolve: function() {
      var _this, run;
      _this = this;
      run = function() {
        $.ItwayIO.cValidator.githubLNK(_this.o.input.val());
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

  $.ItwayIO.githubDialog.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/github-dialog.js.map
