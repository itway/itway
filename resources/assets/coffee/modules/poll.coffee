###
  poll functionality
###
$.ItwayIO.poll =
  o:
    pollOptions: $('#pollOptions')
  activate: ->
    _this = this
    _this.events()
    return
  events: ->
    _this = this
    #quizOptions.find(".options-block .add_new").on("click", _this.addOption(e));
    _this.addOption()
    _this.removeOption()
    return
  addOption: ->
    _this = this
    #define template
    template = $('#pollOptions .options-block:first').clone()
    #define counter
    sectionsCount = 1
    #add new section
    $('body').on 'click', '.add_new', ->
      sectionsCount++
      lengthInput = $('#pollOptions .options-block').length
      #loop through each input
      section = template.clone().find(':input').each(->
        #set id to store the updated section number
        console.log lengthInput
        newId = @id + Number(lengthInput + 1)
        #update for label
        $(this).prev().attr('for', newId).text lengthInput + 1
        #update id
        @id = newId
        return
      ).end().appendTo('#pollOptions')
      false
    return
  removeOption: ->
    _this = this
    _this.o.pollOptions.on 'click', '.remove', ->
      #fade out section
      $(this).fadeOut 300, ->
        #remove parent element (main section)
        lengthInput = $('#pollOptions .options-block').length
        if lengthInput > 1
          $(this).parent().remove()
        console.log lengthInput
        i = 0
        while i <= lengthInput
            newId = 'option-id' + Number(i + 1)
            $('#pollOptions .options-block input').eq(i).attr 'id', newId
            $('#pollOptions .options-block i.icon-circle').eq(i).attr('for', newId).text i + 1
            i++
        false
      return
    return
$.ItwayIO.poll.activate()
