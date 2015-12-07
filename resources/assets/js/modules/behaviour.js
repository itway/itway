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
