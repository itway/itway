###
# TODO LIST CUSTOM PLUGIN
# -----------------------
# This plugin depends on iCheck plugin for checkbox and radio inputs
#
# @type plugin
# @usage $("#todo-widget").todolist( options );
###
(($) ->

  $.fn.todolist = (options) ->
# Render options
    settings = $.extend({
      onCheck: (ele) ->
      onUncheck: (ele) ->

    }, options)
    @each ->
      if typeof $.fn.iCheck != 'undefined'
        $('input', this).on 'ifChecked', (event) ->
          ele = $(this).parents('li').first()
          ele.toggleClass 'done'
          settings.onCheck.call ele
          return
        $('input', this).on 'ifUnchecked', (event) ->
          ele = $(this).parents('li').first()
          ele.toggleClass 'done'
          settings.onUncheck.call ele
          return
      else
        $('input', this).on 'change', (event) ->
          ele = $(this).parents('li').first()
          ele.toggleClass 'done'
          settings.onCheck.call ele
          return
      return

  return
) jQuery

# ---
