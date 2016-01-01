###! ItwayIO app.js
# ================
# Main JS application file for ItwayIO This file
# should be included in all pages. It controls some layout
# options and implements exclusive ItwayIO plugins.
#
# @Author  nilsenj
# @Email   ni_cole@i.ua
# @version 0.1
###

### ----------------------------------
# - Initialize the ItwayIO Object -
# ----------------------------------
# All ItwayIO functions are implemented below.
###

_init = (o) ->

  $.ItwayIO.csrf =
    activate: ->
      $.ajaxSetup headers: 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')


  $.ItwayIO.blog =
    activate: ->
      _this = this
  ### Search functionality ###
  timer = undefined
  $.ItwayIO.search =
    selectors: $.ItwayIO.options.search
    activate: ->
      _this = this
      searchBTN = @selectors.searchBTN
      searchResult = @selectors.searchResult
      searchBTN.click (e) ->
        e.preventDefault()
        _this.search()
        return
      $('.tag-search').on 'click', (e) ->
        e.preventDefault()
        _this.tagSearch()
        return
      $('a.search-button').on 'click', (event) ->
        event.preventDefault()
        $('#search input[type="search"]').focus()
        $('#search').addClass('active')
        $('body').css 'overflow': 'hidden'
        return
      $('#search, #search button.close').on 'click keyup', (event) ->
        if event.target == this or event.target.className == 'close' or event.target.className == 'icon-close' or event.keyCode == 27
          $(this).removeClass 'active'
          searchResult.html ''
          $('#search .search-input').val('')
          $('body').css 'overflow': 'auto'
          _this.stopSearch()
        return
      #Do not include! This prevents the form from submitting for DEMO purposes only!
      $('#search form').submit (event) ->
        event.preventDefault()
        false
      $('#search > form > input[type="search"]').keyup (e) ->
        if (e.keyCode == 13 and $('#search .search-input').val().length > 0) or $('#search .search-input').val().length > 0
          _this.search()
        else
          _this.stopSearch()
        return
      return
    search: ->
      _this = this
      searchResult = @selectors.searchResult
      timer = setTimeout((->
        $.ajax
          url: 'http://www.itway.io/search'
          data: 'keywords': $('#search .search-input').val()
          method: 'post'
          success: (markup) ->
            searchResult.html markup
            return
          error: (err) ->
            searchResult.html '<h3 class="text-danger"> try once more... </h3>'
            console.log err.type
            _this.stopSearch()
            return
        return
      ), 500)
      return
    tagSearch: ->
      _this = this
      searchResult = @selectors.searchResult
      timer = setTimeout((->
        $.ajax
          url: 'http://www.itway.io/getAllExistingTags'
          method: 'post'
          success: (markup) ->
            searchResult.html markup
            return
          error: (err) ->
            searchResult.html '<h3 class="text-danger"> try once more... </h3>'
            console.log err.type
            _this.stopSearch()
            return
        return
      ), 500)
      return
    stopSearch: ->
      clearTimeout timer
      return

  # generate images live rendering
  $.ItwayIO.imageLoad =
    activate: ->
      _this = this
      _this.initiateInstanceImage()
      _this.initiateProfileImage()
      return
    renderInstanceImage: (file, fileinput, settings) ->
      # generate a new FileReader object
      _this = this
      reader = new FileReader
      image = new Image

      reader.onload = (_file) ->
        image.src = _file.target.result
        # url.createObjectURL(file);

        image.onload = ->
          w = @width
          h = @height
          t = file.type
          n = file.name
          s = ~ ~(file.size / 1024) / 1024
          scaleWidth = settings.thumbnail_size
          $('.p').append '<div class=\'s-12 m-12 l-12 xs-12\'><div class=\'thumbnail\' style=\'background: #ffffff\'><img class="img-responsive" src=\'' + image.src + '\' /><div class=\'caption\' style=\'position: absolute;right: 10px;top:10px;\'> <h4  style=\'background: black;padding: 4px; color: white\'>' + s.toFixed(2) + ' Mb </h4></div></div> </div> '
          _this.renderLabelFileName n, 'success'
          return

        image.onerror = ->
          alert 'Invalid file type: ' + file.type
          _this.renderLabelFileName file.name, "error"
          fileinput.val null
          return

        return

      reader.readAsDataURL file
      return
    renderProfileImage: (file, fileinput, settings) ->
# generate a new FileReader object
      _this = this
      reader = new FileReader
      image = new Image

      reader.onload = (_file) ->
        image.src = _file.target.result
        # url.createObjectURL(file);

        image.onload = ->
          w = @width
          h = @height
          t = file.type
          n = file.name
          s = ~ ~(file.size / 1024) / 1024
          scaleWidth = settings.thumbnail_size
          $('.profile-img').attr("src", image.src).css(position: 'relative')
          _this.renderLabelFileProfile(n, "success")
          _this.downButton("success")
          return

        image.onerror = ->
          alert 'Invalid file type: ' + file.type
          _this.renderLabelFileProfile file.name, file.type
          _this.downButton("error")
          fileinput.val null
          return

        return

      reader.readAsDataURL file
      return
    downButton: (message) ->
      _this = this
      button =  $('#upload-button')
      button.removeClass "text-info"
      button.removeClass "text-danger"
      if message == "success"
        button.removeClass "hidden"
        button.addClass "block"
        button.val('to download press').addClass("text-info")
      else
        button.addClass "hidden"
        button.removeClass "block"
        button.addClass("text-danger")
        button.val('wrong file format')
        button.bind "click", ( event ) ->
          event.preventDefault()
          $(this).unbind( event )

    renderLabelFileName: (filename, message)->
      _this = this
      fileLabel = $('.filelabel')
      if fileLabel.find("span.text-info").length > 0 || fileLabel.find("span.text-danger").length > 0
        fileLabel.find("span.text-info").remove()
        fileLabel.find("span.text-danger").remove()

      if message == "success"
        $('.filelabel').append $('<span>').addClass('text-info').css({
          'font-size': '100%'
          'display': 'inline-block'
          'font-weight': 'normal'
          'margin-left': '1em'
          'font-style': 'normal'})
      else
        $('.filelabel').append $('<span>').addClass('text-danger').text(" format is not valid").css({
          'font-size': '100%'
          'display': 'inline-block'
          'font-weight': 'normal'
          'margin-left': '1em'
          'font-style': 'normal'})

    renderLabelFileProfile: (filename, message)->
      _this = this
      fileLabel = $('.label')
      ImgBlock = $('.profile-img')

      if ImgBlock.next("span.text-info").length > 0 || ImgBlock.next("span.text-danger").length > 0
        console.log(ImgBlock.next())
        ImgBlock.next("span.text-info").remove()
        ImgBlock.next("span.text-danger").remove()

      if message == "success"

        ImgBlock.after $('<span>').addClass('text-info').css({
          'font-size': '100%'
          'display': 'inline-block'
          'font-weight': 'normal'
          'margin-left': '1em'
          'font-style': 'normal'})
      else
        ImgBlock.after $('<span>').addClass('text-danger').html("<br/><b>format is not valid </b>").css({
          'font-size': '100%'
          'display': 'inline-block'
          'font-weight': 'normal'
          'margin-left': '1em'
          'font-style': 'normal'})


    initiateInstanceImage: ->
      _this = this
      fileinput = $('#fileupload').attr('accept', 'image/jpeg,image/png,image/gif')
      settings =
        thumbnail_size: 460
        thumbnail_bg_color: '#ddd'
        thumbnail_border: '1px solid #fff'
        thumbnail_shadow: '0 0 0px rgba(0, 0, 0, 0.5)'
        label_text: ''
        warning_message: 'Not an image file.'
        warning_text_color: '#f00'
        input_class: 'custom-file-input button button-primary button-block'
      # when the file is read it triggers the onload event above.
      # handle input changes
      fileinput.change (e) ->
        $('.p').html ''
        if @disabled
          return alert('File upload not supported!')
        F = @files
        if F and F[0]
          i = 0
          while i < F.length
            if F[i].type.match('image.*')
              _this.renderInstanceImage F[i], fileinput, settings
            else _this.renderLabelFileName F[i].name, "error"
            i++
        return
      return

    initiateProfileImage: ->
      _this = this
      fileElement = $('#file').attr('accept', 'image/jpeg,image/png,image/gif')
      settings =
        thumbnail_size: 100
        thumbnail_bg_color: '#ddd'
        thumbnail_border: '3px solid white'
        thumbnail_border_radius: '3px'
        label_text: ''
        warning_message: 'Not an image file.'
        warning_text_color: '#f00'
        input_class: 'custom-file-input button button-primary button-block'
      # when the file is read it triggers the onload event above.
      # handle input changes
      fileElement.change (e) ->
        $('.profile-img-block').html ''
        if @disabled
          return alert('File upload not supported!')
        F = @files
        if F and F[0]
          i = 0
          while i < F.length
            if F[i].type.match('image.*')
              _this.renderProfileImage F[i], fileElement, settings
              _this.renderLabelFileProfile F[i].name, "success"

            else
              _this.renderLabelFileProfile F[i].name, 'error'
              _this.downButton("error")
              fileElement.val(null)

            i++
        return
      return
  $.ItwayIO.messenger =
    activate: ->
      _this = this
      #_this.chatConnected();
      _this.scrollToBottom()
      _this.noRoom()
      _this.createNewRoom()
      o.socket.on 'chat-connected:itway\\Events\\UserEnteredChatEvent', (message) ->
      jqxhr = $.ajax(
        url: '/chat/' + user_id + '/rooms'
        type: 'GET'
        dataType: 'json')
      jqxhr.done (data) ->
        if data.success and data.result.length > 0
          console.log data.result
          $.each data.result, (index, conversation) ->
            o.socket.emit 'join', room: conversation.id
            return
        return
      o.socket.on 'welcome', (data) ->
        console.log data.message
        o.socket.emit 'join', room: current_thread
        return
      o.socket.on 'joined', (data) ->
        console.log data.message
        return
      o.socket.on 'userCount', (data) ->
        chatRightPanel = $('#chatRightPanel')
        if $('#chatRightPanel .numUsers').length >= 1
          chatRightPanel.find('small.numUsers').remove()
          chatRightPanel.append '<small class="numUsers">' + 'online users count ' + data.userCount + '</small>'
        else
          chatRightPanel.append '<small class="numUsers">' + 'online users count ' + data.userCount + '</small>'
        return
      o.socket.on 'userJoined', (data) ->
        userList = $('#users')
        commentUserList = $('.message-wrap')
        userList.find('.media-body .online').remove()
        userList.removeClass 'active'
        commentUserList.find('.comment .online').remove()
        $.each data.users, (index, user) ->
          currentUser = userList.find('a[data-userid=\'' + user.customId + '\']')
          currentCommentUser = commentUserList.find('.comment[data-comment-user=\'' + user.customId + '\']')
          currentUser.addClass 'active'
          currentUser.find('.media-body').append '<span class="online"></span>'
          currentCommentUser.append '<span class="online">online</span>'
          return
        return
      o.socket.on 'connect', (data) ->
        o.socket.emit 'storeClientInfo', customId: user_id
        console.log data
        return
      o.socket.on 'chat.messages:itway\\Events\\ChatMessageCreated', (message) ->
        data = message.data
        $messageList = $('.msg-wrap .comments')
        $conversation = $('.conversation-wrap a[data-room=\'' + data.room + '\']')
        message = data.message.body
        from_user_id = data.message.user_id
        conversation = data.room
        _this.getMessages(from_user_id, conversation).done (data) ->
          $conversation.find('.last-message-body').text message
          if conversation == current_thread
            $messageList.append data
            _this.scrollToBottom()
          if from_user_id != user_id and conversation != current_thread
            _this.updateConversationCounter $conversation
          return
        return
      o.socket.on 'chat.rooms:itway\\Events\\ChatRoomCreated', (message) ->

        $conversationList = $('.rooms .conversation-wrap')
        data = message.data
        $messageList = $('.msg-wrap .comments')
        $conversationTab = $('.button-panel-conversation a[data-tab=\'rooms\']')
        message = data.message.body
        from_user_id = data.message.user_id
        conversation = data.room
        _this.getConversations(user_id, conversation, current_thread).done (data) ->
          if !data.notInRoom
            $conversationList.prepend data
            $conversation = $('.conversation-wrap a[data-room=\'' + conversation + '\']')
            _this.notifyNewRoom $conversationTab
            _this.updateConversationCounter $conversation
          return
        return
      _this.events()
      return
    noRoom: ->
      noRoom = $('#no-room')
      createRoom = $('#create-room')
      if noRoom.length >= 1
        noRoom.addClass 'hidden'
        createRoom.on 'click', (e) ->
          e.preventDefault()
          noRoom.removeClass('hidden').addClass 'active'
          return
      return
    createNewRoom: ->
      $('#chatDropdown').dropdown
        onChange: (value, text, $selectedItem) ->
          console.log value, text, $selectedItem
          return
        transition: 'drop'
      $('#create-room').on 'click', ->
        jqxhr = $.ajax(
          url: '/chat/create'
          type: 'GET'
          dataType: 'html')
        msgWrap = $('.message-wrap')
        jqxhr.done (data) ->
          msgWrap.find('.msg-wrap').addClass 'hidden'
          msgWrap.find('.send-wrap').addClass 'hidden'
          msgWrap.prepend data
          return
        return
      return
    notifyNewRoom: ($conversation) ->
      $badge = $conversation.find('.badge')
      counter = Number($badge.text())
      if $badge.length
        $badge.text counter + 1
      else
        $conversation.append '<span class="badge">1</span>'
      return
    notifyUsers: (user) ->
      usersBlock = $('#users')
      usersBlock.prepend '<div class="user" id=' + user.id + '>' + user.name + '</div>'
      return
    getConversations: (user_id, conversation, current_thread) ->
      jqxhr = $.ajax(
        url: '/chat/conversations'
        type: 'GET'
        data:
          user_id: user_id
          conversation: conversation
          current_thread: current_thread)
      jqxhr
    getMessages: (from_user_id, conversation) ->
      jqxhr = $.ajax(
        url: '/room/getMessage'
        type: 'GET'
        data:
          user_id: from_user_id
          conversation: conversation
        dataType: 'html')
      jqxhr
    sendMessage: (body, conversation, user_id) ->
      jqxhr = $.ajax(
        url: '/room/create-message'
        type: 'POST'
        data:
          body: body
          conversation: conversation
          user_id: user_id
        dataType: 'json')
      jqxhr
    updateConversationCounter: ($conversation) ->
      $badge = $conversation.find('.chat-user-name small .badge')
      counter = Number($badge.text())
      if $badge.length
        $badge.text counter + 1
      else
        $conversation.find('.chat-user-name small').append '<span class="badge">1</span>'
      return
    scrollToBottom: ->
      $messageList = $('.msg-wrap')
      if $messageList.length
        $messageList.animate { scrollTop: $messageList[0].scrollHeight }, 500
      return
    events: ->
      _this = this
      $('#btnSendMessage').on 'click', (evt) ->
        $messageBox = $('#messageBox')
        evt.preventDefault()
        _this.sendMessage($messageBox.val(), current_thread, user_id).done (data) ->
          console.log data
          $messageBox.val ''
          $messageBox.focus()
          return
        return
      $('#btnNewMessage').on 'click', ->
        $('#newMessageModal').modal 'show'
        return

      ###*
      # ctr+Enter to send message
      ###

      $('#messageBox').keypress (event) ->
        if event.keyCode == 13 and event.ctrlKey
          event.preventDefault()
          $('#btnSendMessage').trigger 'click'
        return
      return

  ### Tree()
  # ======
  # Converts the sidebar into a multilevel
  # tree view menu.
  #
  # @type Function
  # @Usage: $.ItwayIO.tree('.sidebar')
  ###

  $.ItwayIO.tree = (menu) ->
    _this = this
    $('li a', $(menu)).on 'click', (e) ->
#Get the clicked link and the next element
      $this = $(this)
      checkElement = $this.next()
      #Check if the next element is a menu and is visible
      if checkElement.is('.treeview-menu') and checkElement.is(':visible')
#Close the menu
        checkElement.slideUp 'normal', ->
          checkElement.removeClass 'menu-open'
          #Fix the layout in case the sidebar stretches over the height of the window
          #_this.layout.fix();
          return
        checkElement.parent('li').removeClass 'active'
      else if checkElement.is('.treeview-menu') and !checkElement.is(':visible')
#Get the parent menu
        parent = $this.parents('ul').first()
        #Close all open menus within the parent
        ul = parent.find('ul:visible').slideUp('normal')
        #Remove the menu-open class from the parent
        ul.removeClass 'menu-open'
        #Get the parent li
        parent_li = $this.parent('li')
        #Open the target menu and add the menu-open class
        checkElement.slideDown 'normal', ->
#Add the class active to the parent li
          checkElement.addClass 'menu-open'
          parent.find('li.active').removeClass 'active'
          parent_li.addClass 'active'
          #Fix the layout in case the sidebar stretches over the height of the window
          _this.layout.fix()
          return
      #if this isn't a link, prevent the page from being redirected
      if checkElement.is('.treeview-menu')
        e.preventDefault()
      return
    return


  ### BoxWidget
  # =========
  # BoxWidget is a plugin to handle collapsing and
  # removing boxes from the screen.
  #
  # @type Object
  # @usage $.ItwayIO.boxWidget.activate()
  #        Set all your options in the main $.ItwayIO.options object
  ###

  $.ItwayIO.boxWidget =
    selectors: $.ItwayIO.options.boxWidgetOptions.boxWidgetSelectors
    icons: $.ItwayIO.options.boxWidgetOptions.boxWidgetIcons
    activate: ->
      _this = this
      #Listen for collapse event triggers
      $(_this.selectors.collapse).on 'click', (e) ->
        e.preventDefault()
        _this.collapse $(this)
        return
      #Listen for remove event triggers
      $(_this.selectors.remove).on 'click', (e) ->
        e.preventDefault()
        _this.remove $(this)
        return
      return
    collapse: (element) ->
      _this = this
      #Find the box parent
      box = element.parents('.box').first()
      #Find the body and the footer
      box_content = box.find('> .box-body, > .box-footer')
      if !box.hasClass('collapsed-box')
#Convert minus into plus
        element.children(':first').removeClass(_this.icons.collapse).addClass _this.icons.open
        #Hide the content
        box_content.slideUp 300, ->
          box.addClass 'collapsed-box'
          return
      else
#Convert plus into minus
        element.children(':first').removeClass(_this.icons.open).addClass _this.icons.collapse
        #Show the content
        box_content.slideDown 300, ->
          box.removeClass 'collapsed-box'
          return
      return
    remove: (element) ->
#Find the box parent
      box = element.parents('.box').first()
      box.slideUp()
      return
  return

'use strict'
#Make sure jQuery has been loaded before app.js
if typeof jQuery == 'undefined'
  throw new Error('ItwayIO requires jQuery')

### ItwayIO
#
# @type Object
# @description $.ItwayIO is the main object for the template's app.
#              It's used for implementing functions and options related
#              to the template. Keeping everything wrapped in an object
#              prevents conflict with other plugins and is a better
#              way to organize our code.
###

$.ItwayIO = {}

### --------------------
# - ItwayIO Options -
# --------------------
# Modify these options to suit your implementation
###

$.ItwayIO.options =
  host: 'http://' + window.location.hostname
  socket: io('http://www.itway.io:6378')
  navbarMenuSlimscroll: true
  navbarMenuSlimscrollWidth: '3px'
  navbarMenuHeight: '200px'
  sidebarControlWidth: '280px'
  sidebarToggleSelector: '[data-toggle=\'offcanvas\']'
  sidebarPushMenu: true
  sidebarSlimScroll: false
  sidebarExpandOnHover: true
  enableBoxRefresh: true
  enableBSToppltip: true
  BSTooltipSelector: '[data-toggle=\'tooltip\']'
  enableFastclick: true
  enableControlSidebar: true
  controlSidebarOptions:
    toggleBtnSelector: '[data-toggle=\'control-sidebar\']'
    selector: '.control-sidebar'
    slide: true
  enableBoxWidget: true
  boxWidgetOptions:
    boxWidgetIcons:
      collapse: 'fa-minus'
      open: 'fa-plus'
      remove: 'fa-times'
    boxWidgetSelectors:
      remove: '[data-widget="remove"]'
      collapse: '[data-widget="collapse"]'
  directChat:
    enable: true
    contactToggleSelector: '[data-widget="chat-pane-toggle"]'
  search:
    searchBTN : $('#search button')
    searchResult : $('.search-result #search-result-body')
  colors:
    lightBlue: '#3c8dbc'
    red: '#f56954'
    green: '#00a65a'
    aqua: '#00c0ef'
    yellow: '#f39c12'
    blue: '#0073b7'
    navy: '#001F3F'
    teal: '#39CCCC'
    olive: '#3D9970'
    lime: '#01FF70'
    orange: '#FF851B'
    fuchsia: '#F012BE'
    purple: '#8E24AA'
    maroon: '#D81B60'
    black: '#222222'
    gray: '#d2d6de'
  screenSizes:
    xs: 480
    sm: 768
    md: 992
    lg: 1200

### ------------------
# - Implementation -
# ------------------
# The next block of code implements ItwayIO's
# functions and plugins as specified by the
# options above.
###

$ ->
#Extend options if external options exist
  if typeof ItwayIOOptions != 'undefined'
    $.extend true, $.ItwayIO.options, ItwayIOOptions
  #Easy access to options
  o = $.ItwayIO.options
  #Set up the object
  _init o

  # activate csrf token
  $.ItwayIO.csrf.activate()

  $.ItwayIO.search.activate()

  # start of handling events and sockets
  #Activate messenger functionality
  $.ItwayIO.messenger.activate()

  $.ItwayIO.imageLoad.activate()
  #Enable sidebar tree view controls

  if o.navbarMenuSlimscroll and typeof $.fn.slimscroll != 'undefined'
    $('.navbar .menu').slimscroll(
      height: o.navbarMenuHeight
      alwaysVisible: false
      size: o.navbarMenuSlimscrollWidth).css 'width', '100%'
   #Activate box widget
  if o.enableBoxWidget
    $.ItwayIO.boxWidget.activate()
  #Activate fast click
  if o.enableFastclick and typeof FastClick != 'undefined'
    FastClick.attach document.body
  #Activate direct chat widget
  if o.directChat.enable
    $(o.directChat.contactToggleSelector).on 'click', ->
      box = $(this).parents('.direct-chat').first()
      box.toggleClass 'direct-chat-contacts-open'
      return

  ###
  # INITIALIZE BUTTON TOGGLE
  # ------------------------
  ###

  $('.button-group[data-toggle="btn-toggle"]').each ->
    group = $(this)
    $(this).find('.button').on 'click', (e) ->
      group.find('.button.active').removeClass 'active'
      $(this).addClass 'active'
      e.preventDefault()
      return
    return
  return
