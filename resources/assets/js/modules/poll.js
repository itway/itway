
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
