(function() {
  $(document).ready(function() {
    $('.tooltip-bottom').tooltipster({
      animation: 'fade',
      delay: 200,
      theme: 'tooltipster-light',
      touchDevices: true,
      trigger: 'hover',
      position: 'bottom'
    });
    $('.tooltip-left').tooltipster({
      animation: 'fade',
      delay: 200,
      theme: 'tooltipster-light',
      touchDevices: true,
      trigger: 'hover',
      position: 'left'
    });
    $('.tooltip-right').tooltipster({
      animation: 'fade',
      delay: 200,
      theme: 'tooltipster-light',
      touchDevices: true,
      trigger: 'hover',
      position: 'right'
    });
    $('.tooltip').tooltipster({
      animation: 'fade',
      delay: 200,
      theme: 'tooltipster-light',
      touchDevices: true,
      trigger: 'hover'
    });
  });

  (function() {
    var anchor, current, definedLinks, i, nav, path;
    nav = document.getElementById('nav');
    anchor = nav.getElementsByTagName('a');
    path = window.location;
    current = window.location.pathname;
    i = 0;
    while (i < anchor.length) {
      definedLinks = anchor[i].pathname;
      if (definedLinks === current) {
        anchor[i].className = 'item selected';
      }
      i++;
    }
  })();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/behaviour.js.map


/*
 * BOX REFRESH BUTTON
 * ------------------
 * This is a custom plugin to use with the component BOX. It allows you to add
 * a refresh button to the box. It converts the box's state to a loading state.
 *
 * @type plugin
 * @usage $("#box-widget").boxRefresh( options );
 */

(function() {
  (function($) {
    $.fn.boxRefresh = function(options) {
      var done, overlay, settings, start;
      settings = $.extend({
        trigger: '.refresh-btn',
        source: '',
        onLoadStart: function(box) {},
        onLoadDone: function(box) {}
      }, options);
      overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');
      start = function(box) {
        box.append(overlay);
        settings.onLoadStart.call(box);
      };
      done = function(box) {
        box.find(overlay).remove();
        settings.onLoadDone.call(box);
      };
      return this.each(function() {
        var box, rBtn;
        if (settings.source === '') {
          if (console) {
            console.log('Please specify a source first - boxRefresh()');
          }
          return;
        }
        box = $(this);
        rBtn = box.find(settings.trigger).first();
        rBtn.on('click', function(e) {
          e.preventDefault();
          start(box);
          box.find('.box-body').load(settings.source, function() {
            done(box);
          });
        });
      });
    };
  })(jQuery);

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/boxRefresh.js.map


/**
 * JavaScript function to match (and return) the video Id
 * of any valid Youtube Url, given as input string.
 */

(function() {
  $.ItwayIO.cValidator = {
    ytVidId: function(url) {
      var p;
      p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
      if (url.match(p)) {
        return RegExp.$1;
      } else {
        return false;
      }
    },
    githubLNK: function(url, opts) {
      var _this, err, error, host, m, path;
      _this = this;
      try {
        m = _this.githubLNKre(opts).exec(url.replace(/\.git(#.*)?$/, ''));
        host = m[1];
        path = m[2];
        return 'https://' + host + '/' + path;
      } catch (error) {
        err = error;
        false;
      }
    },
    githubLNKre: function(opts) {
      var baseUrls;
      opts = opts || {};
      baseUrls = ['gist.github.com', 'github.com'].concat(opts.extraBaseUrls || []);
      return new RegExp(/^(?:https?:\/\/|git:\/\/|git\+ssh:\/\/|git\+https:\/\/)?(?:[^@]+@)?/.source + '(' + baseUrls.join('|') + ')' + /[:\/]([^\/]+\/[^\/]+?|[0-9]+)$/.source);
    }
  };

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/custom-validators.js.map

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


/*
 * TODO LIST CUSTOM PLUGIN
 * -----------------------
 * This plugin depends on iCheck plugin for checkbox and radio inputs
 *
 * @type plugin
 * @usage $("#todo-widget").todolist( options );
 */

(function() {
  (function($) {
    $.fn.todolist = function(options) {
      var settings;
      settings = $.extend({
        onCheck: function(ele) {},
        onUncheck: function(ele) {}
      }, options);
      return this.each(function() {
        if (typeof $.fn.iCheck !== 'undefined') {
          $('input', this).on('ifChecked', function(event) {
            var ele;
            ele = $(this).parents('li').first();
            ele.toggleClass('done');
            settings.onCheck.call(ele);
          });
          $('input', this).on('ifUnchecked', function(event) {
            var ele;
            ele = $(this).parents('li').first();
            ele.toggleClass('done');
            settings.onUncheck.call(ele);
          });
        } else {
          $('input', this).on('change', function(event) {
            var ele;
            ele = $(this).parents('li').first();
            ele.toggleClass('done');
            settings.onCheck.call(ele);
          });
        }
      });
    };
  })(jQuery);

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/todo.js.map

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
