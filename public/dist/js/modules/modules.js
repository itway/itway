(function() {
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
      overlay = $('<div class="overlay"><div class="ui active centered large inline loader"></div></div>');
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


/*
  createToggler functionality
 */

(function() {


}).call(this);

//# sourceMappingURL=coffee-sourcemaps/create-toggler.js.map


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
    speakersNotEmpty: function(value) {
      if (value && value.length >= 2) {
        return value;
      } else {
        return false;
      }
    },
    githubLNKre: function(opts) {
      var baseUrls;
      opts = opts || {};
      baseUrls = ['gist.github.com', 'github.com'].concat(opts.extraBaseUrls || []);
      return new RegExp(/^(?:https?:\/\/|git:\/\/|git\+ssh:\/\/|git\+https:\/\/)?(?:[^@]+@)?/.source + '(' + baseUrls.join('|') + ')' + /[:\/]([^\/]+\/[^\/]+?|[0-9]+)$/.source);
    },
    urlReg: function(url) {
      var p;
      p = "((?:(http|https|Http|Https|rtsp|Rtsp):\\/\\/(?:(?:[a-zA-Z0-9\\$\\-\\_\\.\\+\\!\\*\\'\\(\\)" + "\\,\\;\\?\\&\\=]|(?:\\%[a-fA-F0-9]{2})){1,64}(?:\\:(?:[a-zA-Z0-9\\$\\-\\_" + "\\.\\+\\!\\*\\'\\(\\)\\,\\;\\?\\&\\=]|(?:\\%[a-fA-F0-9]{2})){1,25})?\\@)?)?" + "((?:(?:[a-zA-Z0-9][a-zA-Z0-9\\-]{0,64}\\.)+" + "(?:" + "(?:aero|arpa|asia|a[cdefgilmnoqrstuwxz])" + "|(?:biz|b[abdefghijmnorstvwyz])" + "|(?:cat|com|coop|c[acdfghiklmnoruvxyz])" + "|d[ejkmoz]" + "|(?:edu|e[cegrstu])" + "|f[ijkmor]" + "|(?:gov|g[abdefghilmnpqrstuwy])" + "|h[kmnrtu]" + "|(?:info|int|i[delmnoqrst])" + "|(?:jobs|j[emop])" + "|k[eghimnrwyz]" + "|l[abcikrstuvy]" + "|(?:mil|mobi|museum|m[acdghklmnopqrstuvwxyz])" + "|(?:name|net|n[acefgilopruz])" + "|(?:org|om)" + "|(?:pro|p[aefghklmnrstwy])" + "|qa" + "|r[eouw]" + "|s[abcdeghijklmnortuvyz]" + "|(?:tel|travel|t[cdfghjklmnoprtvwz])" + "|u[agkmsyz]" + "|v[aceginu]" + "|w[fs]" + "|y[etu]" + "|z[amw]))" + "|(?:(?:25[0-5]|2[0-4]" + "[0-9]|[0-1][0-9]{2}|[1-9][0-9]|[1-9])\\.(?:25[0-5]|2[0-4][0-9]" + "|[0-1][0-9]{2}|[1-9][0-9]|[1-9]|0)\\.(?:25[0-5]|2[0-4][0-9]|[0-1]" + "[0-9]{2}|[1-9][0-9]|[1-9]|0)\\.(?:25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}" + "|[1-9][0-9]|[0-9])))" + "(?:\\:\\d{1,5})?)" + "(\\/(?:(?:[a-zA-Z0-9\\;\\/\\?\\:\\@\\&\\=\\#\\~" + "\\-\\.\\+\\!\\*\\'\\(\\)\\,\\_])|(?:\\%[a-fA-F0-9]{2}))*)?" + "(?:\\b|$)";
      if (url.match(p)) {
        return RegExp.$1;
      } else {
        return false;
      }
    }
  };

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/custom-validators.js.map

(function() {
  (function($) {

    /*
    small dropdown plugin
     */
    $.fn.dropit = function(method) {
      var methods;
      methods = {
        init: function(options) {
          this.dropit.settings = $.extend({}, this.dropit.defaults, options);
          return this.each(function() {
            var $el, el, settings;
            $el = $(this);
            el = this;
            settings = $.fn.dropit.settings;
            $el.addClass('dropit').find('>' + settings.triggerParentEl + ':has(' + settings.submenuEl + ')').addClass('dropit-trigger').find(settings.submenuEl).addClass('dropit-submenu').hide();
            $el.off(settings.action).on(settings.action, settings.triggerParentEl + ':has(' + settings.submenuEl + ') > ' + settings.triggerEl + '', function() {
              if (settings.action === 'click' && $(this).parents(settings.triggerParentEl).hasClass('dropit-open')) {
                settings.beforeHide.call(this);
                $(this).parents(settings.triggerParentEl).removeClass('dropit-open').find(settings.submenuEl).hide();
                settings.afterHide.call(this);
                return false;
              }
              settings.beforeHide.call(this);
              $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide();
              settings.afterHide.call(this);
              settings.beforeShow.call(this);
              $(this).parents(settings.triggerParentEl).addClass('dropit-open').find(settings.submenuEl).show();
              settings.afterShow.call(this);
              return false;
            });
            $(document).on('click', function() {
              settings.beforeHide.call(this);
              $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide();
              settings.afterHide.call(this);
            });
            if (settings.action === 'mouseenter') {
              $el.on('mouseleave', '.dropit-open', function() {
                settings.beforeHide.call(this);
                $(this).removeClass('dropit-open').find(settings.submenuEl).hide();
                settings.afterHide.call(this);
              });
            }
            settings.afterLoad.call(this);
          });
        }
      };
      if (methods[method]) {
        return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else if (typeof method === 'object' || !method) {
        return methods.init.apply(this, arguments);
      } else {
        $.error('Method "' + method + '" does not exist in dropit plugin!');
      }
    };
    $.fn.dropit.defaults = {
      action: 'click',
      submenuEl: 'ul',
      triggerEl: 'a',
      triggerParentEl: 'li',
      afterLoad: function() {},
      beforeShow: function() {},
      afterShow: function() {},
      beforeHide: function() {},
      afterHide: function() {}
    };
    $.fn.dropit.settings = {};
  })(jQuery);

  $('#alertlink').dropit();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/dropit.js.map


/*
  events functionality
 */

(function() {
  $.ItwayIO.envents = {
    initialize: function() {
      var _this;
      return _this = this;
    },
    resolve: function() {
      var _this;
      return _this = this;
    },
    stop: function() {
      var _this;
      return _this = this;
    },
    resolveAddon: function() {
      var _this;
      return _this = this;
    }
  };

  $.ItwayIO.envents.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/envents.js.map

(function() {


}).call(this);

//# sourceMappingURL=coffee-sourcemaps/event-dialog.js.map


/*
  events functionality
 */

(function() {
  $.ItwayIO.envents = {
    initialize: function() {
      var _this;
      return _this = this;
    },
    resolve: function() {
      var _this;
      return _this = this;
    },
    stop: function() {
      var _this;
      return _this = this;
    },
    resolveAddon: function() {
      var _this;
      return _this = this;
    }
  };

  $.ItwayIO.envents.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/events.js.map


/*
  github dialog functionality
 */

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
      } else {
        _this.o.dialog.addClass("approved");
        _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl);
        return _this.resolveAddon();
      }
    },
    resolveWithTime: function() {
      var _this;
      _this = this;
      return _this.o.input.keyup(function(e) {
        if ((e.keyCode === 13 && $(e.target).val().length > 5 && $.ItwayIO.cValidator.githubLNK(_this.o.input.val())) || ($(e.target).val().length > 5 && $.ItwayIO.cValidator.githubLNK(_this.o.input.val()))) {
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

(function() {
  $.ItwayIO.imageDialog = {
    o: {
      addonBtn: $("a.photo"),
      dialog: $("[data-remodal-id='photo']"),
      photoBlock: $(".photo-block"),
      photoinput: $('#photoUpload').attr('accept', 'image/jpeg,image/png,image/gif'),
      fileLabel: $(".filelabel"),
      button: $("[data-remodal-id='photo'] .remodal-confirm"),
      templateImage: function(src, size) {
        return '<img class="" src=\'' + src + '\' />';
      }
    },
    activate: function() {
      var _this;
      _this = this;
      _this.initiateDialogImage();
      _this.findImageifExists();
    },
    renderDialogImage: function(file, fileinput, settings) {
      var _this, image, reader;
      _this = this;
      reader = new FileReader;
      image = new Image;
      reader.onload = function(_file) {
        image.src = _file.target.result;
        image.onload = function() {
          var h, n, s, scaleWidth, t, w;
          w = this.width;
          h = this.height;
          t = file.type;
          n = file.name;
          s = ~~(file.size / 1024) / 1024;
          scaleWidth = settings.thumbnail_size;
          _this.o.photoBlock.append(_this.o.templateImage(image.src, s.toFixed(2)));
          _this.renderLabelFileName(n, 'success');
        };
        image.onerror = function() {
          alert('Invalid file type: ' + file.type);
          _this.renderLabelFileName(file.name, "error");
          fileinput.val(null);
        };
      };
      reader.readAsDataURL(file);
    },
    findImageifExists: function() {
      var _this;
      _this = this;
      if (_this.o.photoBlock.find("img").length >= 1) {
        _this.o.fileLabel.addClass('hasImage');
        return _this.o.addonBtn.prepend("<span class='addon'><b class='text-danger'>+1</b> added</span>");
      } else {
        _this.o.fileLabel.removeClass('hasImage');
        return _this.o.addonBtn.find(".addon").remove();
      }
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
    },
    renderLabelFileName: function(filename, message) {
      var _this, fileLabel;
      _this = this;
      fileLabel = $('.filelabel');
      if (fileLabel.find("i.text-success").length > 0 || fileLabel.find("i.text-danger").length > 0) {
        fileLabel.find("i.text-success.icon-expand_more").remove();
        fileLabel.find("i.text-danger").remove();
      }
      if (message === "success") {
        return _this.o.fileLabel.addClass('hasImage');
      } else {
        _this.o.fileLabel.removeClass('hasImage');
        return _this.o.fileLabel.append($('<i>').addClass('text-danger').text("format is not valid").css({
          'font-size': '14px',
          'display': 'block',
          'font-weight': 'normal',
          'font-style': 'normal'
        }));
      }
    },
    confirmImage: function(input) {
      var _this;
      _this = this;
      return _this.o.button.on("click", function(e) {
        var newInput;
        if ($("[data-photo-id='photo-input']").length < 1) {
          newInput = input.attr("data-photo-id", "photo-input");
          _this.o.addonBtn.after(newInput);
        } else {
          $("[data-photo-id='photo-input']").remove();
          newInput = input.attr("data-photo-id", "photo-input");
          _this.o.addonBtn.after(newInput);
        }
        _this.o.dialog.addClass("approved");
        return _this.resolveAddon();
      });
    },
    initiateDialogImage: function() {
      var _this, settings;
      _this = this;
      settings = {
        thumbnail_size: 460,
        thumbnail_bg_color: '#ddd',
        thumbnail_border: '1px solid #fff',
        thumbnail_shadow: '0 0 0px rgba(0, 0, 0, 0.5)',
        label_text: '',
        warning_message: 'Not an image file.',
        warning_text_color: '#f00',
        input_class: 'custom-file-input button button-primary button-block'
      };
      _this.o.photoinput.change(function(e) {
        var F, i;
        _this.o.photoBlock.html('');
        if (this.disabled) {
          return alert('File upload not supported!');
        }
        F = this.files;
        if (F && F[0]) {
          i = 0;
          while (i < F.length) {
            if (F[i].type.match('image.*')) {
              _this.renderDialogImage(F[i], _this.o.photoinput, settings);
              _this.confirmImage($(e.target));
            } else {
              _this.renderLabelFileName(F[i].name, "error");
              _this.o.dialog.removeClass("approved");
            }
            i++;
          }
        }
      });
    }
  };

  $.ItwayIO.imageDialog.activate();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/image-dialog.js.map


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
      redirectIFerror: APP_URL + "/auth/login"
    },
    activate: function() {
      var _this;
      _this = this;
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


/* Notifier
 * ======
 * Notifies posts and notifies admin about the users and posts.
 *
 * @type Object
 * @usage $.ItwayIO.notifier.activate()
 *        $.ItwayIO.notifier.newPostCreated()
 *        $.ItwayIO.notifier.addNotifiedState()
 */

(function() {
  $.ItwayIO.notifier = {
    o: {
      host: 'http://' + window.location.hostname,
      socket: io(APP_URL + ':6378'),
      notifyBlock: $('.notify'),
      notifyArea: $('.notify .panel'),
      notifyBtn: $('#alertlink'),
      warningTempl: "<div class=\"text-danger\">Something happened.</div>",
      notifyTempl: function(host, instance, link, title, author) {
        return "<li class=\"activity\"> <a class=\"link\" href=\"" + link + "\"> <span class=\"ui tag tiny label\">@{instance}</span> <span class=\"link-block\"> <span class=\"title\">" + title + "</span> <span class=\"author\"> <span>author:</span>" + author + "</span> </span></a> </li>";
      }
    },
    activate: function() {
      var _this;
      _this = this;
      return _this.newInstanceCreated();
    },
    newInstanceCreated: function() {
      var _this;
      _this = this;
      return _this.o.socket.on('post-created:itway\\Events\\PostWasCreatedEvent', function(message) {
        _this.o.notifyArea.prepend(_this.o.notifyTempl(o.host, message.keys[0], message.link(message.title, message.user.name)));
        return _this.addNotifiedState();
      });
    },
    addNotifiedState: function() {
      var _this;
      _this = this;
      return _this.o.notifyBtn.prepend('<span class="has-notify"></span>');
    },
    removeNotifiedState: function() {
      var _this;
      _this = this;
      return _this.o.notifyBtn.bind('click', function() {
        if ($(this).find('span.has-notify').length > 0) {
          return $(this).find('span.has-notify').remove();
        }
      });
    },
    toggleNotify: function() {
      var _this;
      _this = this;
      return _this.o.notifyBtn.dropit();
    }
  };

  $.ItwayIO.notifier.activate();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/notifier.js.map


/*
  poll functionality
 */

(function() {
  $.ItwayIO.poll = {
    o: {
      pollOptions: $('#pollOptions')
    },
    activate: function() {
      var _this;
      _this = this;
      _this.events();
    },
    events: function() {
      var _this;
      _this = this;
      _this.addOption();
      _this.removeOption();
    },
    addOption: function() {
      var _this, sectionsCount, template;
      _this = this;
      template = $('#pollOptions .options-block:first').clone();
      sectionsCount = 1;
      $('body').on('click', '.add_new', function() {
        var lengthInput, section;
        sectionsCount++;
        lengthInput = $('#pollOptions .options-block').length;
        section = template.clone().find(':input').each(function() {
          var newId;
          console.log(lengthInput);
          newId = this.id + Number(lengthInput + 1);
          $(this).prev().attr('for', newId).text(lengthInput + 1);
          this.id = newId;
        }).end().appendTo('#pollOptions');
        return false;
      });
    },
    removeOption: function() {
      var _this;
      _this = this;
      _this.o.pollOptions.on('click', '.remove', function() {
        $(this).fadeOut(300, function() {
          var i, lengthInput, newId;
          lengthInput = $('#pollOptions .options-block').length;
          if (lengthInput > 1) {
            $(this).parent().remove();
          }
          console.log(lengthInput);
          i = 0;
          while (i <= lengthInput) {
            newId = 'option-id' + Number(i + 1);
            $('#pollOptions .options-block input').eq(i).attr('id', newId);
            $('#pollOptions .options-block i.icon-circle').eq(i).attr('for', newId).text(i + 1);
            i++;
          }
          return false;
        });
      });
    }
  };

  $.ItwayIO.poll.activate();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/poll.js.map


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


/*
  youtube dialog functionality
 */

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
      if (_this.o.dialog.length >= 1) {
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
        } else {
          _this.o.dialog.addClass("approved");
          _this.o.dialog.find('.modal-form').after(_this.o.dialogTempl(ytId));
          return _this.resolveAddon();
        }
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

(function() {


}).call(this);

//# sourceMappingURL=coffee-sourcemaps/youtube-enhance.js.map
