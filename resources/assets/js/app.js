
/*! ItwayIO app.js
 * ================
 * Main JS application file for ItwayIO This file
 * should be included in all pages. It controls some layout
 * options and implements exclusive ItwayIO plugins.
 *
 * @Author  nilsenj
 * @Email   ni_cole@i.ua
 * @version 0.1
 */


/* ----------------------------------
 * - Initialize the ItwayIO Object -
 * ----------------------------------
 * All ItwayIO functions are implemented below.
 */

(function() {
  var _init;

  _init = function(o) {
    var timer;
    $.ItwayIO.csrf = {
      activate: function() {
        return $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      }
    };
    $.ItwayIO.blog = {
      activate: function() {
        var _this;
        return _this = this;
      }
    };

    /* Search functionality */
    timer = void 0;
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
        var _this, searchResult;
        _this = this;
        searchResult = this.selectors.searchResult;
        timer = setTimeout((function() {
          $.ajax({
            url: APP_URL + '/search',
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
        var _this, searchResult;
        _this = this;
        searchResult = this.selectors.searchResult;
        timer = setTimeout((function() {
          $.ajax({
            url: APP_URL + '/getAllExistingTags',
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
    $.ItwayIO.imageLoad = {
      activate: function() {
        var _this;
        _this = this;
        _this.initiateInstanceImage();
        _this.initiateProfileImage();
      },
      renderInstanceImage: function(file, fileinput, settings) {
        var _this, image, reader;
        _this = this;
        reader = new FileReader;
        image = new Image;
        reader.onload = function(_file) {
          image.src = _file.target.result;
          image.onload = function() {
            var h, n, s, scaleWidth, t, w;
            w = this.width;
            h = this.height;
            t = file.type;
            n = file.name;
            s = ~~(file.size / 1024) / 1024;
            scaleWidth = settings.thumbnail_size;
            $('.p').append('<div class=\'s-12 m-12 l-12 xs-12\'><div class=\'thumbnail\' style=\'background: #ffffff\'><img class="img-responsive" src=\'' + image.src + '\' /><div class=\'caption\' style=\'position: absolute;right: 10px;top:10px;\'> <h4  style=\'background: black;padding: 4px; color: white\'>' + s.toFixed(2) + ' Mb </h4></div></div> </div> ');
            _this.renderLabelFileName(n, 'success');
          };
          image.onerror = function() {
            alert('Invalid file type: ' + file.type);
            _this.renderLabelFileName(file.name, "error");
            fileinput.val(null);
          };
        };
        reader.readAsDataURL(file);
      },
      renderProfileImage: function(file, fileinput, settings) {
        var _this, image, reader;
        _this = this;
        reader = new FileReader;
        image = new Image;
        reader.onload = function(_file) {
          image.src = _file.target.result;
          image.onload = function() {
            var h, n, s, scaleWidth, t, w;
            w = this.width;
            h = this.height;
            t = file.type;
            n = file.name;
            s = ~~(file.size / 1024) / 1024;
            scaleWidth = settings.thumbnail_size;
            $('.profile-img').attr("src", image.src).css({
              position: 'relative'
            });
            _this.renderLabelFileProfile(n, "success");
            _this.downButton("success");
          };
          image.onerror = function() {
            alert('Invalid file type: ' + file.type);
            _this.renderLabelFileProfile(file.name, file.type);
            _this.downButton("error");
            fileinput.val(null);
          };
        };
        reader.readAsDataURL(file);
      },
      downButton: function(message) {
        var _this, button;
        _this = this;
        button = $('#upload-button');
        button.removeClass("text-info");
        button.removeClass("text-danger");
        if (message === "success") {
          button.removeClass("hidden");
          button.addClass("block");
          return button.val('to download press').addClass("text-info");
        } else {
          button.addClass("hidden");
          button.removeClass("block");
          button.addClass("text-danger");
          button.val('wrong file format');
          return button.bind("click", function(event) {
            event.preventDefault();
            return $(this).unbind(event);
          });
        }
      },
      renderLabelFileName: function(filename, message) {
        var _this, fileLabel;
        _this = this;
        fileLabel = $('.filelabel');
        if (fileLabel.find("span.text-info").length > 0 || fileLabel.find("span.text-danger").length > 0) {
          fileLabel.find("span.text-info").remove();
          fileLabel.find("span.text-danger").remove();
        }
        if (message === "success") {
          return $('.filelabel').append($('<span>').addClass('text-info').css({
            'font-size': '100%',
            'display': 'inline-block',
            'font-weight': 'normal',
            'margin-left': '1em',
            'font-style': 'normal'
          }));
        } else {
          return $('.filelabel').append($('<span>').addClass('text-danger').text(" format is not valid").css({
            'font-size': '100%',
            'display': 'inline-block',
            'font-weight': 'normal',
            'margin-left': '1em',
            'font-style': 'normal'
          }));
        }
      },
      renderLabelFileProfile: function(filename, message) {
        var ImgBlock, _this, fileLabel;
        _this = this;
        fileLabel = $('.label');
        ImgBlock = $('.profile-img');
        if (ImgBlock.next("span.text-info").length > 0 || ImgBlock.next("span.text-danger").length > 0) {
          console.log(ImgBlock.next());
          ImgBlock.next("span.text-info").remove();
          ImgBlock.next("span.text-danger").remove();
        }
        if (message === "success") {
          return ImgBlock.after($('<span>').addClass('text-info').css({
            'font-size': '100%',
            'display': 'inline-block',
            'font-weight': 'normal',
            'margin-left': '1em',
            'font-style': 'normal'
          }));
        } else {
          return ImgBlock.after($('<span>').addClass('text-danger').html("<br/><b>format is not valid </b>").css({
            'font-size': '100%',
            'display': 'inline-block',
            'font-weight': 'normal',
            'margin-left': '1em',
            'font-style': 'normal'
          }));
        }
      },
      initiateInstanceImage: function() {
        var _this, fileinput, settings;
        _this = this;
        fileinput = $('#fileupload').attr('accept', 'image/jpeg,image/png,image/gif');
        settings = {
          thumbnail_size: 460,
          thumbnail_bg_color: '#ddd',
          thumbnail_border: '1px solid #fff',
          thumbnail_shadow: '0 0 0px rgba(0, 0, 0, 0.5)',
          label_text: '',
          warning_message: 'Not an image file.',
          warning_text_color: '#f00',
          input_class: 'custom-file-input button button-primary button-block'
        };
        fileinput.change(function(e) {
          var F, i;
          $('.p').html('');
          if (this.disabled) {
            return alert('File upload not supported!');
          }
          F = this.files;
          if (F && F[0]) {
            i = 0;
            while (i < F.length) {
              if (F[i].type.match('image.*')) {
                _this.renderInstanceImage(F[i], fileinput, settings);
              } else {
                _this.renderLabelFileName(F[i].name, "error");
              }
              i++;
            }
          }
        });
      },
      initiateProfileImage: function() {
        var _this, fileElement, settings;
        _this = this;
        fileElement = $('#file').attr('accept', 'image/jpeg,image/png,image/gif');
        settings = {
          thumbnail_size: 100,
          thumbnail_bg_color: '#ddd',
          thumbnail_border: '3px solid white',
          thumbnail_border_radius: '3px',
          label_text: '',
          warning_message: 'Not an image file.',
          warning_text_color: '#f00',
          input_class: 'custom-file-input button button-primary button-block'
        };
        fileElement.change(function(e) {
          var F, i;
          $('.profile-img-block').html('');
          if (this.disabled) {
            return alert('File upload not supported!');
          }
          F = this.files;
          if (F && F[0]) {
            i = 0;
            while (i < F.length) {
              if (F[i].type.match('image.*')) {
                _this.renderProfileImage(F[i], fileElement, settings);
                _this.renderLabelFileProfile(F[i].name, "success");
              } else {
                _this.renderLabelFileProfile(F[i].name, 'error');
                _this.downButton("error");
                fileElement.val(null);
              }
              i++;
            }
          }
        });
      }
    };
    $.ItwayIO.messenger = {
      activate: function() {
        var _this, jqxhr;
        _this = this;
        _this.scrollToBottom();
        _this.noRoom();
        _this.createNewRoom();
        o.socket.on('chat-connected:itway\\Events\\UserEnteredChatEvent', function(message) {});
        jqxhr = $.ajax({
          url: '/chat/' + user_id + '/rooms',
          type: 'GET',
          dataType: 'json'
        });
        jqxhr.done(function(data) {
          if (data.success && data.result.length > 0) {
            console.log(data.result);
            $.each(data.result, function(index, conversation) {
              o.socket.emit('join', {
                room: conversation.id
              });
            });
          }
        });
        o.socket.on('welcome', function(data) {
          console.log(data.message);
          o.socket.emit('join', {
            room: current_thread
          });
        });
        o.socket.on('joined', function(data) {
          console.log(data.message);
        });
        o.socket.on('userCount', function(data) {
          var chatRightPanel;
          chatRightPanel = $('#chatRightPanel');
          if ($('#chatRightPanel .numUsers').length >= 1) {
            chatRightPanel.find('small.numUsers').remove();
            chatRightPanel.append('<small class="numUsers">' + 'online users count ' + data.userCount + '</small>');
          } else {
            chatRightPanel.append('<small class="numUsers">' + 'online users count ' + data.userCount + '</small>');
          }
        });
        o.socket.on('userJoined', function(data) {
          var commentUserList, userList;
          userList = $('#users');
          commentUserList = $('.message-wrap');
          userList.find('.media-body .online').remove();
          userList.removeClass('active');
          commentUserList.find('.comment .online').remove();
          $.each(data.users, function(index, user) {
            var currentCommentUser, currentUser;
            currentUser = userList.find('a[data-userid=\'' + user.customId + '\']');
            currentCommentUser = commentUserList.find('.comment[data-comment-user=\'' + user.customId + '\']');
            currentUser.addClass('active');
            currentUser.find('.media-body').append('<span class="online"></span>');
            currentCommentUser.append('<span class="online">online</span>');
          });
        });
        o.socket.on('connect', function(data) {
          o.socket.emit('storeClientInfo', {
            customId: user_id
          });
          console.log(data);
        });
        o.socket.on('chat.messages:itway\\Events\\ChatMessageCreated', function(message) {
          var $conversation, $messageList, conversation, data, from_user_id;
          data = message.data;
          $messageList = $('.msg-wrap .comments');
          $conversation = $('.conversation-wrap a[data-room=\'' + data.room + '\']');
          message = data.message.body;
          from_user_id = data.message.user_id;
          conversation = data.room;
          _this.getMessages(from_user_id, conversation).done(function(data) {
            $conversation.find('.last-message-body').text(message);
            if (conversation === current_thread) {
              $messageList.append(data);
              _this.scrollToBottom();
            }
            if (from_user_id !== user_id && conversation !== current_thread) {
              _this.updateConversationCounter($conversation);
            }
          });
        });
        o.socket.on('chat.rooms:itway\\Events\\ChatRoomCreated', function(message) {
          var $conversationList, $conversationTab, $messageList, conversation, data, from_user_id;
          $conversationList = $('.rooms .conversation-wrap');
          data = message.data;
          $messageList = $('.msg-wrap .comments');
          $conversationTab = $('.button-panel-conversation a[data-tab=\'rooms\']');
          message = data.message.body;
          from_user_id = data.message.user_id;
          conversation = data.room;
          _this.getConversations(user_id, conversation, current_thread).done(function(data) {
            var $conversation;
            if (!data.notInRoom) {
              $conversationList.prepend(data);
              $conversation = $('.conversation-wrap a[data-room=\'' + conversation + '\']');
              _this.notifyNewRoom($conversationTab);
              _this.updateConversationCounter($conversation);
            }
          });
        });
        _this.events();
      },
      noRoom: function() {
        var createRoom, noRoom;
        noRoom = $('#no-room');
        createRoom = $('#create-room');
        if (noRoom.length >= 1) {
          noRoom.addClass('hidden');
          createRoom.on('click', function(e) {
            e.preventDefault();
            noRoom.removeClass('hidden').addClass('active');
          });
        }
      },
      createNewRoom: function() {
        $('#chatDropdown').dropdown({
          onChange: function(value, text, $selectedItem) {
            console.log(value, text, $selectedItem);
          },
          transition: 'drop'
        });
        $('#create-room').on('click', function() {
          var jqxhr, msgWrap;
          jqxhr = $.ajax({
            url: '/chat/create',
            type: 'GET',
            dataType: 'html'
          });
          msgWrap = $('.message-wrap');
          jqxhr.done(function(data) {
            msgWrap.find('.msg-wrap').addClass('hidden');
            msgWrap.find('.send-wrap').addClass('hidden');
            msgWrap.prepend(data);
          });
        });
      },
      notifyNewRoom: function($conversation) {
        var $badge, counter;
        $badge = $conversation.find('.badge');
        counter = Number($badge.text());
        if ($badge.length) {
          $badge.text(counter + 1);
        } else {
          $conversation.append('<span class="badge">1</span>');
        }
      },
      notifyUsers: function(user) {
        var usersBlock;
        usersBlock = $('#users');
        usersBlock.prepend('<div class="user" id=' + user.id + '>' + user.name + '</div>');
      },
      getConversations: function(user_id, conversation, current_thread) {
        var jqxhr;
        jqxhr = $.ajax({
          url: '/chat/conversations',
          type: 'GET',
          data: {
            user_id: user_id,
            conversation: conversation,
            current_thread: current_thread
          }
        });
        return jqxhr;
      },
      getMessages: function(from_user_id, conversation) {
        var jqxhr;
        jqxhr = $.ajax({
          url: '/room/getMessage',
          type: 'GET',
          data: {
            user_id: from_user_id,
            conversation: conversation
          },
          dataType: 'html'
        });
        return jqxhr;
      },
      sendMessage: function(body, conversation, user_id) {
        var jqxhr;
        jqxhr = $.ajax({
          url: '/room/create-message',
          type: 'POST',
          data: {
            body: body,
            conversation: conversation,
            user_id: user_id
          },
          dataType: 'json'
        });
        return jqxhr;
      },
      updateConversationCounter: function($conversation) {
        var $badge, counter;
        $badge = $conversation.find('.chat-user-name small .badge');
        counter = Number($badge.text());
        if ($badge.length) {
          $badge.text(counter + 1);
        } else {
          $conversation.find('.chat-user-name small').append('<span class="badge">1</span>');
        }
      },
      scrollToBottom: function() {
        var $messageList;
        $messageList = $('.msg-wrap');
        if ($messageList.length) {
          $messageList.animate({
            scrollTop: $messageList[0].scrollHeight
          }, 500);
        }
      },
      events: function() {
        var _this;
        _this = this;
        $('#btnSendMessage').on('click', function(evt) {
          var $messageBox;
          $messageBox = $('#messageBox');
          evt.preventDefault();
          _this.sendMessage($messageBox.val(), current_thread, user_id).done(function(data) {
            console.log(data);
            $messageBox.val('');
            $messageBox.focus();
          });
        });
        $('#btnNewMessage').on('click', function() {
          $('#newMessageModal').modal('show');
        });

        /**
         * ctr+Enter to send message
         */
        $('#messageBox').keypress(function(event) {
          if (event.keyCode === 13 && event.ctrlKey) {
            event.preventDefault();
            $('#btnSendMessage').trigger('click');
          }
        });
      }
    };

    /* Tree()
     * ======
     * Converts the sidebar into a multilevel
     * tree view menu.
     *
     * @type Function
     * @Usage: $.ItwayIO.tree('.sidebar')
     */
    $.ItwayIO.tree = function(menu) {
      var _this;
      _this = this;
      $('li a', $(menu)).on('click', function(e) {
        var $this, checkElement, parent, parent_li, ul;
        $this = $(this);
        checkElement = $this.next();
        if (checkElement.is('.treeview-menu') && checkElement.is(':visible')) {
          checkElement.slideUp('normal', function() {
            checkElement.removeClass('menu-open');
          });
          checkElement.parent('li').removeClass('active');
        } else if (checkElement.is('.treeview-menu') && !checkElement.is(':visible')) {
          parent = $this.parents('ul').first();
          ul = parent.find('ul:visible').slideUp('normal');
          ul.removeClass('menu-open');
          parent_li = $this.parent('li');
          checkElement.slideDown('normal', function() {
            checkElement.addClass('menu-open');
            parent.find('li.active').removeClass('active');
            parent_li.addClass('active');
            _this.layout.fix();
          });
        }
        if (checkElement.is('.treeview-menu')) {
          e.preventDefault();
        }
      });
    };

    /* BoxWidget
     * =========
     * BoxWidget is a plugin to handle collapsing and
     * removing boxes from the screen.
     *
     * @type Object
     * @usage $.ItwayIO.boxWidget.activate()
     *        Set all your options in the main $.ItwayIO.options object
     */
    $.ItwayIO.boxWidget = {
      selectors: $.ItwayIO.options.boxWidgetOptions.boxWidgetSelectors,
      icons: $.ItwayIO.options.boxWidgetOptions.boxWidgetIcons,
      activate: function() {
        var _this;
        _this = this;
        $(_this.selectors.collapse).on('click', function(e) {
          e.preventDefault();
          _this.collapse($(this));
        });
        $(_this.selectors.remove).on('click', function(e) {
          e.preventDefault();
          _this.remove($(this));
        });
      },
      collapse: function(element) {
        var _this, box, box_content;
        _this = this;
        box = element.parents('.box').first();
        box_content = box.find('> .box-body, > .box-footer');
        if (!box.hasClass('collapsed-box')) {
          element.children(':first').removeClass(_this.icons.collapse).addClass(_this.icons.open);
          box_content.slideUp(300, function() {
            box.addClass('collapsed-box');
          });
        } else {
          element.children(':first').removeClass(_this.icons.open).addClass(_this.icons.collapse);
          box_content.slideDown(300, function() {
            box.removeClass('collapsed-box');
          });
        }
      },
      remove: function(element) {
        var box;
        box = element.parents('.box').first();
        box.slideUp();
      }
    };
  };

  'use strict';

  if (typeof jQuery === 'undefined') {
    throw new Error('ItwayIO requires jQuery');
  }


  /* ItwayIO
   *
   * @type Object
   * @description $.ItwayIO is the main object for the template's app.
   *              It's used for implementing functions and options related
   *              to the template. Keeping everything wrapped in an object
   *              prevents conflict with other plugins and is a better
   *              way to organize our code.
   */

  $.ItwayIO = {};


  /* --------------------
   * - ItwayIO Options -
   * --------------------
   * Modify these options to suit your implementation
   */

  $.ItwayIO.options = {
    host: 'http://' + window.location.hostname,
    socket: io(APP_URL + ':6378'),
    navbarMenuSlimscroll: true,
    navbarMenuSlimscrollWidth: '3px',
    navbarMenuHeight: '200px',
    sidebarControlWidth: '280px',
    sidebarToggleSelector: '[data-toggle=\'offcanvas\']',
    sidebarPushMenu: true,
    sidebarSlimScroll: false,
    sidebarExpandOnHover: true,
    enableBoxRefresh: true,
    enableBSToppltip: true,
    BSTooltipSelector: '[data-toggle=\'tooltip\']',
    enableFastclick: true,
    enableControlSidebar: true,
    controlSidebarOptions: {
      toggleBtnSelector: '[data-toggle=\'control-sidebar\']',
      selector: '.control-sidebar',
      slide: true
    },
    enableBoxWidget: true,
    boxWidgetOptions: {
      boxWidgetIcons: {
        collapse: 'fa-minus',
        open: 'fa-plus',
        remove: 'fa-times'
      },
      boxWidgetSelectors: {
        remove: '[data-widget="remove"]',
        collapse: '[data-widget="collapse"]'
      }
    },
    directChat: {
      enable: true,
      contactToggleSelector: '[data-widget="chat-pane-toggle"]'
    },
    search: {
      searchBTN: $('#search button'),
      searchResult: $('.search-result #search-result-body')
    },
    colors: {
      lightBlue: '#3c8dbc',
      red: '#f56954',
      green: '#00a65a',
      aqua: '#00c0ef',
      yellow: '#f39c12',
      blue: '#0073b7',
      navy: '#001F3F',
      teal: '#39CCCC',
      olive: '#3D9970',
      lime: '#01FF70',
      orange: '#FF851B',
      fuchsia: '#F012BE',
      purple: '#8E24AA',
      maroon: '#D81B60',
      black: '#222222',
      gray: '#d2d6de'
    },
    screenSizes: {
      xs: 480,
      sm: 768,
      md: 992,
      lg: 1200
    }
  };


  /* ------------------
   * - Implementation -
   * ------------------
   * The next block of code implements ItwayIO's
   * functions and plugins as specified by the
   * options above.
   */

  $(function() {
    var o;
    if (typeof ItwayIOOptions !== 'undefined') {
      $.extend(true, $.ItwayIO.options, ItwayIOOptions);
    }
    o = $.ItwayIO.options;
    _init(o);
    $.ItwayIO.csrf.activate();
    $.ItwayIO.search.activate();
    $.ItwayIO.messenger.activate();
    $.ItwayIO.imageLoad.activate();
    if (o.navbarMenuSlimscroll && typeof $.fn.slimscroll !== 'undefined') {
      $('.navbar .menu').slimscroll({
        height: o.navbarMenuHeight,
        alwaysVisible: false,
        size: o.navbarMenuSlimscrollWidth
      }).css('width', '100%');
    }
    if (o.enableBoxWidget) {
      $.ItwayIO.boxWidget.activate();
    }
    if (o.enableFastclick && typeof FastClick !== 'undefined') {
      FastClick.attach(document.body);
    }
    if (o.directChat.enable) {
      $(o.directChat.contactToggleSelector).on('click', function() {
        var box;
        box = $(this).parents('.direct-chat').first();
        box.toggleClass('direct-chat-contacts-open');
      });
    }

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
    $('.button-group[data-toggle="btn-toggle"]').each(function() {
      var group;
      group = $(this);
      $(this).find('.button').on('click', function(e) {
        group.find('.button.active').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
      });
    });
  });

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/app.js.map
