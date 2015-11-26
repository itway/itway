###
# BOX REFRESH BUTTON
# ------------------
# This is a custom plugin to use with the component BOX. It allows you to add
# a refresh button to the box. It converts the box's state to a loading state.
#
# @type plugin
# @usage $("#box-widget").boxRefresh( options );
###

(($) ->

  $.fn.boxRefresh = (options) ->
# Render options
    settings = $.extend({
      trigger: '.refresh-btn'
      source: ''
      onLoadStart: (box) ->
      onLoadDone: (box) ->

    }, options)
    #The overlay
    overlay = $('<div class="overlay"><div class="ui active centered large inline loader"></div></div>')

    start = (box) ->
#Add overlay and loading img
      box.append overlay
      settings.onLoadStart.call box
      return

    done = (box) ->
#Remove overlay and loading img
      box.find(overlay).remove()
      settings.onLoadDone.call box
      return

    @each ->
#if a source is specified
      if settings.source == ''
        if console
          console.log 'Please specify a source first - boxRefresh()'
        return
      #the box
      box = $(this)
      #the button
      rBtn = box.find(settings.trigger).first()
      #On trigger click
      rBtn.on 'click', (e) ->
        e.preventDefault()
        #Add loading overlay
        start box
        #Perform ajax call
        box.find('.box-body').load settings.source, ->
          done box
          return
        return
      return

  return
) jQuery
