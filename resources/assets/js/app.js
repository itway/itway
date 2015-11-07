
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

    /* Notifier
     * ======
     * Notifies posts and notifies admin about the users and posts.
     *
     * @type Object
     * @usage $.ItwayIO.notifier.activate()
     *        $.ItwayIO.notifier.newPostCreated()
     *        $.ItwayIO.notifier.addNotifiedState()
     */
    var timer;
    $.ItwayIO.notifier = {
      activate: function() {
        var _this;
        _this = this;
        _this.newPostCreated();
        _this.removeNotifiedState();
      },
      newPostCreated: function() {
        var _this;
        _this = this;
        o.socket.on('post-created:itway\\Events\\PostWasCreatedEvent', function(message) {
          o.notifyBlock.prepend('<div class="control-sidebar-heading">New Post added</div> <li><span class="has-notify"></span>' + '<a class="message-link" href="' + o.host + '/' + message.post.locale + '/blog/post/' + message.post.id + '"> ' + '<p class="message-title">' + message.post.title + '</p> ' + '<small class="notifier-info text-center" >' + message.post.preamble + '<div class="clearfix"></div>' + '<img class="avatar" src="' + o.host + '/images/users/' + message.user.photo + '" alt=""></img> ' + '<span class="author">' + message.user.name + '</span> </small>' + '</a></li>');
          o.notifyBlock.data('data-new', 'present');
          _this.addNotifiedState();
        });
      },
      addNotifiedState: function() {
        o.notifyBtn.prepend('<span class="has-notify"></span>');
      },
      removeNotifiedState: function() {
        o.notifyBtn.bind('click', function() {
          if ($(this).find('span.has-notify').length > 0) {
            $(this).find('span.has-notify').remove();
          }
        });
      }
    };
    timer = void 0;

    /* Search functionality */
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
        var _this, searchResult;
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
    $.ItwayIO.likeBTN = {
      activate: function(buttonID, base_url, class_name, object_id, redirectIFerror) {
        if (buttonID.length !== 0) {
          buttonID.submit(function(e) {
            var button, buttonI;
            e.preventDefault();
            button = $(this).find('button');
            buttonI = $(this).find('button i');
            $.ajax({
              type: 'GET',
              url: base_url,
              data: {
                'class_name': class_name,
                'object_id': object_id
              },
              success: function(data) {
                if (data === 'error') {
                  window.location.href = redirectIFerror;
                }
                if (data[0] === 'liked') {
                  buttonI.addClass('text-danger');
                  buttonI.removeClass('icon-favorite_outline');
                  buttonI.addClass('icon-favorite');
                  button.tooltipster('content', data[1]);
                  buttonID.parent().append($('<span/>', {
                    'text': data[2],
                    'class': 'like-message'
                  }));
                  $('span .like-message').animate({
                    opacity: 0.25,
                    left: '+=50',
                    height: 'toggle'
                  }, 200);
                } else {
                  buttonI.removeClass('text-danger');
                  buttonI.addClass('icon-favorite_outline');
                  buttonI.removeClass('icon-favorite');
                  button.tooltipster('content', data[1]);
                  buttonID.parent().find('.like-message').remove();
                }
              },
              error: function(data) {
                console.log('error' + '   ' + data);
              }
            }, 'html');
          });
        }
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
        var image, reader;
        console.log('something is hapenning!');
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
            $('.p').append('<div class=\'s-12 m-10 l-10 l-offset-1 m-offset-1\'><div class=\'thumbnail\' style=\'background: #ffffff\'><img src=\'' + image.src + '\' /><div class=\'caption\' style=\'position: absolute;right: 10px;top:10px;\'> <h4  style=\'background: black;padding: 4px; color: white\'>' + s.toFixed(2) + ' Mb </h4></div></div> </div> ');
          };
          image.onerror = function() {
            alert('Invalid file type: ' + file.type);
            fileinput.val(null);
          };
        };
        reader.readAsDataURL(file);
      },
      renderProfileImage: function(file, fileinput, settings) {
        var image, reader;
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
            $('.profile-img-block').append('<img class="img profile-img" align="center" src=\'' + image.src + '\' /> ').css({
              position: 'relative'
            });
            $('#changeImage .button.button-primary.button-block').val('to download press').addClass('text-success');
          };
          image.onerror = function() {
            alert('Invalid file type: ' + file.type);
            fileinput.val(null);
          };
        };
        reader.readAsDataURL(file);
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
                console.log('file matches');
                if ($('.image-error').length >= 1) {
                  $('.image-error').remove();
                }
                _this.renderInstanceImage(F[i], fileinput, settings);
              } else {
                $('.filelabel').append($('<small>').addClass('image-error').text(settings.warning_message).css({
                  'font-size': '100%',
                  'color': settings.warning_text_color,
                  'display': 'inline-block',
                  'font-weight': 'normal',
                  'margin-left': '1em',
                  'font-style': 'normal'
                }));
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
                if ($('.image-error')) {
                  $('.image-error').remove();
                }
                _this.renderProfileImage(F[i], fileElement, settings);
              } else {
                $('.profile-img-block').append($('<small>').addClass('image-error').text(settings.warning_message).css({
                  'font-size': '100%',
                  'color': settings.warning_text_color,
                  'display': 'inline-block',
                  'font-weight': 'normal',
                  'margin-left': '1em',
                  'font-style': 'normal'
                }));
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
          var message;
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
          var message;
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
    $.ItwayIO.quiz = {
      activate: function() {
        var _this;
        _this = this;
        _this.events();
      },
      events: function() {
        var _this, quizOptions;
        _this = this;
        quizOptions = $('#quizOptions');
        _this.addOption();
        _this.removeOption();
      },
      addOption: function() {
        var sectionsCount, template;
        template = $('#quizOptions .options-block:first').clone();
        sectionsCount = 1;
        $('body').on('click', '.add_new', function() {
          var lengthInput, section;
          sectionsCount++;
          lengthInput = $('#quizOptions .options-block').length;
          section = template.clone().find(':input').each(function() {
            var newId;
            console.log(lengthInput);
            newId = this.id + Number(lengthInput + 1);
            $(this).prev().attr('for', newId).text(lengthInput + 1);
            this.id = newId;
          }).end().appendTo('#quizOptions');
          return false;
        });
      },
      removeOption: function() {
        $('#quizOptions').on('click', '.remove', function() {
          $(this).fadeOut(300, function() {
            var i, lengthInput, newId;
            $(this).parent().remove();
            lengthInput = $('#quizOptions .options-block').length;
            console.log(lengthInput);
            i = 0;
            while (i <= lengthInput) {
              newId = 'option-id' + Number(i + 1);
              $('#quizOptions .options-block input').eq(i).attr('id', newId);
              $('#quizOptions .options-block i.icon-circle').eq(i).attr('for', newId).text(i + 1);
              i++;
            }
            return false;
          });
        });
      }
    };

    /* Layout
     * ======
     * Fixes the layout height in case min-height fails.
     *
     * @type Object
     * @usage $.ItwayIO.layout.activate()
     *        $.ItwayIO.layout.fix()
     *        $.ItwayIO.layout.fixSidebar()
     */
    $.ItwayIO.layout = {
      activate: function() {
        var _this;
        _this = this;
        _this.fix();
        _this.fixSidebar();
        $(window, '.container.wrapper').resize(function() {
          _this.fix();
          _this.fixSidebar();
        });
      },
      fix: function() {
        var controlSidebar, neg, postSetWidth, sidebar_height, window_height;
        neg = $('#navigation').outerHeight() + $('#footer').outerHeight();
        window_height = $(window).height();
        sidebar_height = $('.sidebar').height();
        if ($('body').hasClass('fixed')) {
          $('.content-wrapper, .right-side').css('min-height', window_height - $('#footer').outerHeight());
        } else {
          postSetWidth = void 0;
          if (window_height >= sidebar_height) {
            $('.content-wrapper, .right-side').css('min-height', window_height - neg);
            postSetWidth = window_height - neg;
          } else {
            $('.content-wrapper, .right-side').css('min-height', sidebar_height);
            postSetWidth = sidebar_height;
          }
          controlSidebar = $($.ItwayIO.options.controlSidebarOptions.selector);
          if (typeof controlSidebar !== 'undefined') {
            if (controlSidebar.height() > postSetWidth) {
              $('.content-wrapper, .right-side').css('min-height', controlSidebar.height());
            }
          }
        }
      },
      fixSidebar: function() {
        if (!$('body').hasClass('fixed')) {
          if (typeof $.fn.slimScroll !== 'undefined') {
            $('.sidebar').slimScroll({
              destroy: true
            }).height('auto');
          }
          return;
        } else if (typeof $.fn.slimScroll === 'undefined' && console) {
          console.error('Error: the fixed layout requires the slimscroll plugin!');
        }
        if ($.ItwayIO.options.sidebarSlimScroll) {
          if (typeof $.fn.slimScroll !== 'undefined') {
            $('.sidebar').slimScroll({
              destroy: true
            }).height('auto');
            $('.sidebar').slimscroll({
              height: $(window).height() - $('#navigation').height() + 'px',
              color: 'rgba(0,0,0,0.2)',
              size: '3px'
            });
          }
        }
      }
    };

    /* PushMenu()
     * ==========
     * Adds the push menu functionality to the sidebar.
     *
     * @type Function
     * @usage: $.ItwayIO.pushMenu("[data-toggle='offcanvas']")
     */
    $.ItwayIO.pushMenu = {
      activate: function(toggleBtn) {
        var screenSizes;
        screenSizes = $.ItwayIO.options.screenSizes;
        $(toggleBtn).on('click', function(e) {
          e.preventDefault();
          console.log('notifier clicked');
          if ($(window).width() > screenSizes.sm - 1) {
            $('body').toggleClass('sidebar-collapse');
          } else {
            if ($('body').hasClass('sidebar-open')) {
              $('body').removeClass('sidebar-open');
              $('body').removeClass('sidebar-collapse');
            } else {
              $('body').addClass('sidebar-open');
            }
          }
        });
        $('.content-wrapper').click(function() {
          if ($(window).width() <= screenSizes.sm - 1 && $('body').hasClass('sidebar-open')) {
            $('body').removeClass('sidebar-open');
          }
        });
        if ($.ItwayIO.options.sidebarExpandOnHover || $('body').hasClass('fixed') && $('body').hasClass('sidebar-mini')) {
          this.expandOnHover();
        }
      },
      expandOnHover: function() {
        var _this, screenWidth;
        _this = this;
        screenWidth = $.ItwayIO.options.screenSizes.sm - 1;
        $('.main-sidebar').hover((function() {
          if ($('body').hasClass('sidebar-mini') && $('body').hasClass('sidebar-collapse') && $(window).width() > screenWidth) {
            _this.expand();
          }
        }), function() {
          if ($('body').hasClass('sidebar-mini') && $('body').hasClass('sidebar-expanded-on-hover') && $(window).width() > screenWidth) {
            _this.collapse();
          }
        });
      },
      expand: function() {
        $('body').removeClass('sidebar-collapse').addClass('sidebar-expanded-on-hover');
      },
      collapse: function() {
        if ($('body').hasClass('sidebar-expanded-on-hover')) {
          $('body').removeClass('sidebar-expanded-on-hover').addClass('sidebar-collapse');
        }
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

    /* ControlSidebar
     * ==============
     * Adds functionality to the right sidebar
     *
     * @type Object
     * @usage $.ItwayIO.controlSidebar.activate(options)
     */
    $.ItwayIO.controlSidebar = {
      activate: function() {
        var o;
        var _this, bg, btn, sidebar;
        _this = this;
        o = $.ItwayIO.options.controlSidebarOptions;
        sidebar = $(o.selector);
        btn = $(o.toggleBtnSelector);
        btn.on('click', function(e) {
          e.preventDefault();
          if (!sidebar.hasClass('control-sidebar-open') && !$('body').hasClass('control-sidebar-open')) {
            _this.open(sidebar, o.slide);
            $(this).addClass('active');
          } else {
            _this.close(sidebar, o.slide);
            $(this).removeClass('active');
          }
        });
        bg = $('.control-sidebar-bg');
        _this._fix(bg);
        if ($('body').hasClass('fixed')) {
          _this._fixForFixed(sidebar);
        } else {
          if ($('.content-wrapper, .right-side').height() < sidebar.height()) {
            _this._fixForContent(sidebar);
          }
        }
      },
      open: function(sidebar, slide) {
        var _this;
        _this = this;
        if (slide) {
          sidebar.addClass('control-sidebar-open');
        } else {
          $('body').addClass('control-sidebar-open');
        }
      },
      close: function(sidebar, slide) {
        if (slide) {
          sidebar.removeClass('control-sidebar-open');
        } else {
          $('body').removeClass('control-sidebar-open');
        }
      },
      _fix: function(sidebar) {
        var _this, neg;
        _this = this;
        neg = $('#navigation').outerHeight();
        if ($('body').hasClass('layout-boxed')) {
          sidebar.css('position', 'absolute');
          sidebar.height($(window).height() / 2 - neg).css({
            'overflow-y': 'auto'
          });
          $(window).resize(function() {
            _this._fix(sidebar);
          });
        } else {
          sidebar.css({
            'position': 'fixed',
            'height': 'auto'
          });
        }
      },
      _fixForFixed: function(sidebar) {
        sidebar.css({
          'position': 'fixed',
          'max-height': '100%',
          'overflow': 'auto',
          'padding-bottom': '50px'
        });
      },
      _fixForContent: function(sidebar) {
        $('.content-wrapper, .right-side').css('min-height', sidebar.height());
      }
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
    socket: io('http://www.itway.io:6378'),
    notifyBlock: $('.notify'),
    notifyBtn: $('.button-notify'),
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
      searchResult: $('.search-result')
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
    $.ItwayIO.search.activate();
    $.ItwayIO.notifier.activate();
    $.ItwayIO.layout.activate();
    $.ItwayIO.messenger.activate();
    $.ItwayIO.quiz.activate();
    if ((typeof buttonID && typeof base_url && typeof class_name && typeof object_id && typeof redirectIFerror) !== 'undefined') {
      $.ItwayIO.likeBTN.activate(buttonID, base_url, class_name, object_id, redirectIFerror);
    }
    $.ItwayIO.imageLoad.activate();
    $.ItwayIO.tree('.sidebar');
    if (o.enableControlSidebar) {
      $.ItwayIO.controlSidebar.activate();
    }
    if (o.navbarMenuSlimscroll && typeof $.fn.slimscroll !== 'undefined') {
      $('.navbar .menu').slimscroll({
        height: o.navbarMenuHeight,
        alwaysVisible: false,
        size: o.navbarMenuSlimscrollWidth
      }).css('width', '100%');
    }
    if (o.sidebarPushMenu) {
      $.ItwayIO.pushMenu.activate(o.sidebarToggleSelector);
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


  /* ------------------
   * - Custom Plugins -
   * ------------------
   * All custom plugins are defined below.
   */


  /*
   * BOX REFRESH BUTTON
   * ------------------
   * This is a custom plugin to use with the component BOX. It allows you to add
   * a refresh button to the box. It converts the box's state to a loading state.
   *
   * @type plugin
   * @usage $("#box-widget").boxRefresh( options );
   */

  (function($) {
    $.fn.boxRefresh = function(options) {
      var done, overlay, settings, start;
      settings = $.extend({
        trigger: '.refresh-btn',
        source: '',
        onLoadStart: function(box) {},
        onLoadDone: function(box) {}
      }, options);
      overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');
      start = function(box) {
        box.append(overlay);
        settings.onLoadStart.call(box);
      };
      done = function(box) {
        box.find(overlay).remove();
        settings.onLoadDone.call(box);
      };
      return this.each(function() {
        var box, rBtn;
        if (settings.source === '') {
          if (console) {
            console.log('Please specify a source first - boxRefresh()');
          }
          return;
        }
        box = $(this);
        rBtn = box.find(settings.trigger).first();
        rBtn.on('click', function(e) {
          e.preventDefault();
          start(box);
          box.find('.box-body').load(settings.source, function() {
            done(box);
          });
        });
      });
    };
  })(jQuery);


  /*
   * TODO LIST CUSTOM PLUGIN
   * -----------------------
   * This plugin depends on iCheck plugin for checkbox and radio inputs
   *
   * @type plugin
   * @usage $("#todo-widget").todolist( options );
   */

  (function($) {
    $.fn.todolist = function(options) {
      var settings;
      settings = $.extend({
        onCheck: function(ele) {},
        onUncheck: function(ele) {}
      }, options);
      return this.each(function() {
        if (typeof $.fn.iCheck !== 'undefined') {
          $('input', this).on('ifChecked', function(event) {
            var ele;
            ele = $(this).parents('li').first();
            ele.toggleClass('done');
            settings.onCheck.call(ele);
          });
          $('input', this).on('ifUnchecked', function(event) {
            var ele;
            ele = $(this).parents('li').first();
            ele.toggleClass('done');
            settings.onUncheck.call(ele);
          });
        } else {
          $('input', this).on('change', function(event) {
            var ele;
            ele = $(this).parents('li').first();
            ele.toggleClass('done');
            settings.onCheck.call(ele);
          });
        }
      });
    };
  })(jQuery);

}).call(this);

//# sourceMappingURL=coffee-sourcemaps/app.js.map
