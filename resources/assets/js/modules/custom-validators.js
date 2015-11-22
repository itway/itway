
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
