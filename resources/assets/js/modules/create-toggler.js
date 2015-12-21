
/*
  createToggler functionality
 */

(function() {
  $.ItwayIO.createToggler = {
    o: {
      host: 'http://' + window.location.hostname,
      togglerInput: $("#create-instance"),
      instance: $("#create-instance").attr("data-instance"),
      organizer_link: $("[name='organizer_link']"),
      warningTempl: "<div class=\"text-danger\">OOPS something went wrong.</div>",
      dialogTempl: "<div class=\"\"> <i class=\"icon-plus_one\"></i> </div>"
    },
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

  $.ItwayIO.createToggler.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/create-toggler.js.map
