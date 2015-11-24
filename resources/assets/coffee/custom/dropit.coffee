(($) ->

  $.fn.dropit = (method) ->
    methods = init: (options) ->
      @dropit.settings = $.extend({}, @dropit.defaults, options)
      @each ->
        $el = $(this)
        el = this
        settings = $.fn.dropit.settings
        # Hide initial submenus
        $el.addClass('dropit').find('>' + settings.triggerParentEl + ':has(' + settings.submenuEl + ')').addClass('dropit-trigger').find(settings.submenuEl).addClass('dropit-submenu').hide()
        # Open on click
        $el.off(settings.action).on settings.action, settings.triggerParentEl + ':has(' + settings.submenuEl + ') > ' + settings.triggerEl + '', ->
          # Close click menu's if clicked again
          if settings.action == 'click' and $(this).parents(settings.triggerParentEl).hasClass('dropit-open')
            settings.beforeHide.call this
            $(this).parents(settings.triggerParentEl).removeClass('dropit-open').find(settings.submenuEl).hide()
            settings.afterHide.call this
            return false
          # Hide open menus
          settings.beforeHide.call this
          $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide()
          settings.afterHide.call this
          # Open this menu
          settings.beforeShow.call this
          $(this).parents(settings.triggerParentEl).addClass('dropit-open').find(settings.submenuEl).show()
          settings.afterShow.call this
          false
        # Close if outside click
        $(document).on 'click', ->
          settings.beforeHide.call this
          $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide()
          settings.afterHide.call this
          return
        # If hover
        if settings.action == 'mouseenter'
          $el.on 'mouseleave', '.dropit-open', ->
            settings.beforeHide.call this
            $(this).removeClass('dropit-open').find(settings.submenuEl).hide()
            settings.afterHide.call this
            return
        settings.afterLoad.call this
        return
    if methods[method]
      return methods[method].apply(this, Array::slice.call(arguments, 1))
    else if typeof method == 'object' or !method
      return methods.init.apply(this, arguments)
    else
      $.error 'Method "' + method + '" does not exist in dropit plugin!'
    return

  $.fn.dropit.defaults =
    action: 'click'
    submenuEl: 'ul'
    triggerEl: 'a'
    triggerParentEl: 'li'
    afterLoad: ->
    beforeShow: ->
    afterShow: ->
    beforeHide: ->
    afterHide: ->
  $.fn.dropit.settings = {}
  return
) jQuery
$('#alertlink').dropit()
