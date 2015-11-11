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


/* Search functionality */

(function() {
  $.ItwayIO.search = {
    selectors: $.ItwayIO.options.search,
    activate: function() {
      var _this, searchBTN, searchResult;
      _this = this;
      searchBTN = this.selectors.searchBTN;
      searchResult = this.selectors.searchResult;
      searchBTN.click(function(e) {
        e.preventDefault();
        _this.search();
      });
      $('.tag-search').on('click', function(e) {
        e.preventDefault();
        _this.tagSearch();
      });
      $('a.search-button').on('click', function(event) {
        event.preventDefault();
        $('#search input[type="search"]').focus();
        $('#search').addClass('active');
        $('body').css({
          'overflow': 'hidden'
        });
      });
      $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target === this || event.target.className === 'close' || event.target.className === 'icon-close' || event.keyCode === 27) {
          $(this).removeClass('active');
          searchResult.html('');
          $('#search .search-input').val('');
          $('body').css({
            'overflow': 'auto'
          });
          _this.stopSearch();
        }
      });
      $('#search form').submit(function(event) {
        event.preventDefault();
        return false;
      });
      $('#search > form > input[type="search"]').keyup(function(e) {
        if ((e.keyCode === 13 && $('#search .search-input').val().length > 0) || $('#search .search-input').val().length > 0) {
          _this.search();
        } else {
          _this.stopSearch();
        }
      });
    },
    search: function() {
      var _this, searchResult, timer;
      _this = this;
      searchResult = this.selectors.searchResult;
      timer = setTimeout((function() {
        $.ajax({
          url: 'http://www.itway.io/search',
          data: {
            'keywords': $('#search .search-input').val()
          },
          method: 'post',
          success: function(markup) {
            searchResult.html(markup);
          },
          error: function(err) {
            searchResult.html('<h3 class="text-danger"> try once more... </h3>');
            console.log(err.type);
            _this.stopSearch();
          }
        });
      }), 500);
    },
    tagSearch: function() {
      var _this, searchResult, timer;
      _this = this;
      searchResult = this.selectors.searchResult;
      timer = setTimeout((function() {
        $.ajax({
          url: 'http://www.itway.io/getAllExistingTags',
          method: 'post',
          success: function(markup) {
            searchResult.html(markup);
          },
          error: function(err) {
            searchResult.html('<h3 class="text-danger"> try once more... </h3>');
            console.log(err.type);
            _this.stopSearch();
          }
        });
      }), 500);
    },
    stopSearch: function() {
      clearTimeout(timer);
    }
  };

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/search.js.map
