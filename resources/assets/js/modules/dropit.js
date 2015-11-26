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
