
/*
  events functionality
 */

(function() {
  $.ItwayIO.envents = {
    o: {
      dialog: $("[data-remodal-id='create-event']"),
      button: $("[data-remodal-id='create-event'] .remodal-confirm"),
      organizer_link: $("[name='organizer_link']"),
      addonBtn: $("a.github-link"),
      timer: void 0,
      warningTempl: "<div class=\"text-danger\">The url is not real.</div>",
      dialogTempl: "<div class=\"organizer_link-input-success input-success \"> <i class=\"icon-plus_one\"></i> </div>"
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

  $.ItwayIO.envents.initialize();

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/envents.js.map
