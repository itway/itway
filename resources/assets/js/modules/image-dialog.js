(function() {
  $.ItwayIO.imageDialog = {
    o: {
      addonBtn: $("a.photo"),
      dialog: $("[data-remodal-id='photo']"),
      photoBlock: $(".photo-block"),
      photoinput: $('#photoUpload').attr('accept', 'image/jpeg,image/png,image/gif'),
      button: $("[data-remodal-id='photo'] .remodal-confirm"),
      templateImage: function(src, size) {
        return '<div class=\'s-12 m-12 l-12 xs-12\'><div class=\'thumbnail\' style=\'background: #ffffff\'><img class="img-responsive" src=\'' + src + '\' /><div class=\'caption\' style=\'position: absolute;right: 10px;top:10px;\'> <h4  style=\'background: black;padding: 4px; color: white\'>' + size + ' Mb </h4></div></div> </div> ';
      }
    },
    activate: function() {
      var _this;
      _this = this;
      _this.initiateDialogImage();
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
      if (fileLabel.find("span.text-info").length > 0 || fileLabel.find("span.text-danger").length > 0) {
        fileLabel.find("span.text-info").remove();
        fileLabel.find("span.text-danger").remove();
      }
      if (message === "success") {
        return $('.filelabel').append($('<span>').addClass('text-info').text(filename).css({
          'font-size': '100%',
          'display': 'inline-block',
          'font-weight': 'normal',
          'margin-left': '1em',
          'font-style': 'normal'
        }));
      } else {
        return $('.filelabel').append($('<span>').addClass('text-danger').text(filename + " format is not valid").css({
          'font-size': '100%',
          'display': 'inline-block',
          'font-weight': 'normal',
          'margin-left': '1em',
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
