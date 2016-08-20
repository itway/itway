
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
