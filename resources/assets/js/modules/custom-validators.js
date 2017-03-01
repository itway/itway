
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
      var _this, err, host, m, path;
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
