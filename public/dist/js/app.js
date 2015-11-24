(function(){var e;if(e=function(e){var t;$.ItwayIO.csrf={activate:function(){return $.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}})}},$.ItwayIO.blog={activate:function(){var e;return e=this}},t=void 0,$.ItwayIO.search={selectors:$.ItwayIO.options.search,activate:function(){var e,t,o;e=this,t=this.selectors.searchBTN,o=this.selectors.searchResult,t.click(function(t){t.preventDefault(),e.search()}),$(".tag-search").on("click",function(t){t.preventDefault(),e.tagSearch()}),$("a.search-button").on("click",function(e){e.preventDefault(),$('#search input[type="search"]').focus(),$("#search").addClass("active"),$("body").css({overflow:"hidden"})}),$("#search, #search button.close").on("click keyup",function(t){(t.target===this||"close"===t.target.className||"icon-close"===t.target.className||27===t.keyCode)&&($(this).removeClass("active"),o.html(""),$("#search .search-input").val(""),$("body").css({overflow:"auto"}),e.stopSearch())}),$("#search form").submit(function(e){return e.preventDefault(),!1}),$('#search > form > input[type="search"]').keyup(function(t){13===t.keyCode&&$("#search .search-input").val().length>0||$("#search .search-input").val().length>0?e.search():e.stopSearch()})},search:function(){var e,o;e=this,o=this.selectors.searchResult,t=setTimeout(function(){$.ajax({url:"http://www.itway.io/search",data:{keywords:$("#search .search-input").val()},method:"post",success:function(e){o.html(e)},error:function(t){o.html('<h3 class="text-danger"> try once more... </h3>'),console.log(t.type),e.stopSearch()}})},500)},tagSearch:function(){var e,o;e=this,o=this.selectors.searchResult,t=setTimeout(function(){$.ajax({url:"http://www.itway.io/getAllExistingTags",method:"post",success:function(e){o.html(e)},error:function(t){o.html('<h3 class="text-danger"> try once more... </h3>'),console.log(t.type),e.stopSearch()}})},500)},stopSearch:function(){clearTimeout(t)}},$.ItwayIO.likeBTN={activate:function(e,t,o,n,a){0!==e.length&&e.submit(function(s){var i,r;s.preventDefault(),i=$(this).find("button"),r=$(this).find("button i"),$.ajax({type:"GET",url:t,data:{class_name:o,object_id:n},success:function(t){"error"===t&&(window.location.href=a),"liked"===t[0]?(r.addClass("text-danger"),r.removeClass("icon-favorite_outline"),r.addClass("icon-favorite"),i.tooltipster("content",t[1]),e.parent().append($("<span/>",{text:t[2],"class":"like-message"})),$("span .like-message").animate({opacity:.25,left:"+=50",height:"toggle"},200)):(r.removeClass("text-danger"),r.addClass("icon-favorite_outline"),r.removeClass("icon-favorite"),i.tooltipster("content",t[1]),e.parent().find(".like-message").remove())},error:function(e){console.log("error   "+e)}},"html")})}},$.ItwayIO.imageLoad={activate:function(){var e;e=this,e.initiateInstanceImage(),e.initiateProfileImage()},renderInstanceImage:function(e,t,o){var n,a,s;n=this,s=new FileReader,a=new Image,s.onload=function(s){a.src=s.target.result,a.onload=function(){var t,s,i,r,l,c;c=this.width,t=this.height,l=e.type,s=e.name,i=~~(e.size/1024)/1024,r=o.thumbnail_size,$(".p").append("<div class='s-12 m-12 l-12 xs-12'><div class='thumbnail' style='background: #ffffff'><img class=\"img-responsive\" src='"+a.src+"' /><div class='caption' style='position: absolute;right: 10px;top:10px;'> <h4  style='background: black;padding: 4px; color: white'>"+i.toFixed(2)+" Mb </h4></div></div> </div> "),n.renderLabelFileName(s,"success")},a.onerror=function(){alert("Invalid file type: "+e.type),n.renderLabelFileName(e.name,"error"),t.val(null)}},s.readAsDataURL(e)},renderProfileImage:function(e,t,o){var n,a,s;n=this,s=new FileReader,a=new Image,s.onload=function(s){a.src=s.target.result,a.onload=function(){var t,s,i,r,l,c;c=this.width,t=this.height,l=e.type,s=e.name,i=~~(e.size/1024)/1024,r=o.thumbnail_size,$(".profile-img").attr("src",a.src).css({position:"relative"}),n.renderLabelFileProfile(s,"success"),n.downButton("success")},a.onerror=function(){alert("Invalid file type: "+e.type),n.renderLabelFileProfile(e.name,e.type),n.downButton("error"),t.val(null)}},s.readAsDataURL(e)},downButton:function(e){var t,o;return t=this,o=$("#upload-button"),o.removeClass("text-info"),o.removeClass("text-danger"),"success"===e?(o.removeClass("hidden"),o.addClass("block"),o.val("to download press").addClass("text-info")):(o.addClass("hidden"),o.removeClass("block"),o.addClass("text-danger"),o.val("wrong file format"),o.bind("click",function(e){return e.preventDefault(),$(this).unbind(e)}))},renderLabelFileName:function(e,t){var o,n;return o=this,n=$(".filelabel"),(n.find("span.text-info").length>0||n.find("span.text-danger").length>0)&&(n.find("span.text-info").remove(),n.find("span.text-danger").remove()),$(".filelabel").append("success"===t?$("<span>").addClass("text-info").text(e).css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}):$("<span>").addClass("text-danger").text(e+" format is not valid").css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}))},renderLabelFileProfile:function(e,t){var o,n,a;return n=this,a=$(".label"),o=$(".profile-img"),(o.next("span.text-info").length>0||o.next("span.text-danger").length>0)&&(console.log(o.next()),o.next("span.text-info").remove(),o.next("span.text-danger").remove()),o.after("success"===t?$("<span>").addClass("text-info").html(e).css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}):$("<span>").addClass("text-danger").html(e+"<br/><b>format is not valid </b>").css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}))},initiateInstanceImage:function(){var e,t,o;e=this,t=$("#fileupload").attr("accept","image/jpeg,image/png,image/gif"),o={thumbnail_size:460,thumbnail_bg_color:"#ddd",thumbnail_border:"1px solid #fff",thumbnail_shadow:"0 0 0px rgba(0, 0, 0, 0.5)",label_text:"",warning_message:"Not an image file.",warning_text_color:"#f00",input_class:"custom-file-input button button-primary button-block"},t.change(function(){var n,a;if($(".p").html(""),this.disabled)return alert("File upload not supported!");if(n=this.files,n&&n[0])for(a=0;a<n.length;)n[a].type.match("image.*")?e.renderInstanceImage(n[a],t,o):e.renderLabelFileName(n[a].name,"error"),a++})},initiateProfileImage:function(){var e,t,o;e=this,t=$("#file").attr("accept","image/jpeg,image/png,image/gif"),o={thumbnail_size:100,thumbnail_bg_color:"#ddd",thumbnail_border:"3px solid white",thumbnail_border_radius:"3px",label_text:"",warning_message:"Not an image file.",warning_text_color:"#f00",input_class:"custom-file-input button button-primary button-block"},t.change(function(){var n,a;if($(".profile-img-block").html(""),this.disabled)return alert("File upload not supported!");if(n=this.files,n&&n[0])for(a=0;a<n.length;)n[a].type.match("image.*")?(e.renderProfileImage(n[a],t,o),e.renderLabelFileProfile(n[a].name,"success")):(e.renderLabelFileProfile(n[a].name,"error"),e.downButton("error"),t.val(null)),a++})}},$.ItwayIO.messenger={activate:function(){var t,o;t=this,t.scrollToBottom(),t.noRoom(),t.createNewRoom(),e.socket.on("chat-connected:itway\\Events\\UserEnteredChatEvent",function(){}),o=$.ajax({url:"/chat/"+user_id+"/rooms",type:"GET",dataType:"json"}),o.done(function(t){t.success&&t.result.length>0&&(console.log(t.result),$.each(t.result,function(t,o){e.socket.emit("join",{room:o.id})}))}),e.socket.on("welcome",function(t){console.log(t.message),e.socket.emit("join",{room:current_thread})}),e.socket.on("joined",function(e){console.log(e.message)}),e.socket.on("userCount",function(e){var t;t=$("#chatRightPanel"),$("#chatRightPanel .numUsers").length>=1?(t.find("small.numUsers").remove(),t.append('<small class="numUsers">online users count '+e.userCount+"</small>")):t.append('<small class="numUsers">online users count '+e.userCount+"</small>")}),e.socket.on("userJoined",function(e){var t,o;o=$("#users"),t=$(".message-wrap"),o.find(".media-body .online").remove(),o.removeClass("active"),t.find(".comment .online").remove(),$.each(e.users,function(e,n){var a,s;s=o.find("a[data-userid='"+n.customId+"']"),a=t.find(".comment[data-comment-user='"+n.customId+"']"),s.addClass("active"),s.find(".media-body").append('<span class="online"></span>'),a.append('<span class="online">online</span>')})}),e.socket.on("connect",function(t){e.socket.emit("storeClientInfo",{customId:user_id}),console.log(t)}),e.socket.on("chat.messages:itway\\Events\\ChatMessageCreated",function(e){var o,n,a,s,i;s=e.data,n=$(".msg-wrap .comments"),o=$(".conversation-wrap a[data-room='"+s.room+"']"),e=s.message.body,i=s.message.user_id,a=s.room,t.getMessages(i,a).done(function(s){o.find(".last-message-body").text(e),a===current_thread&&(n.append(s),t.scrollToBottom()),i!==user_id&&a!==current_thread&&t.updateConversationCounter(o)})}),e.socket.on("chat.rooms:itway\\Events\\ChatRoomCreated",function(e){var o,n,a,s,i,r;o=$(".rooms .conversation-wrap"),i=e.data,a=$(".msg-wrap .comments"),n=$(".button-panel-conversation a[data-tab='rooms']"),e=i.message.body,r=i.message.user_id,s=i.room,t.getConversations(user_id,s,current_thread).done(function(e){var a;e.notInRoom||(o.prepend(e),a=$(".conversation-wrap a[data-room='"+s+"']"),t.notifyNewRoom(n),t.updateConversationCounter(a))})}),t.events()},noRoom:function(){var e,t;t=$("#no-room"),e=$("#create-room"),t.length>=1&&(t.addClass("hidden"),e.on("click",function(e){e.preventDefault(),t.removeClass("hidden").addClass("active")}))},createNewRoom:function(){$("#chatDropdown").dropdown({onChange:function(e,t,o){console.log(e,t,o)},transition:"drop"}),$("#create-room").on("click",function(){var e,t;e=$.ajax({url:"/chat/create",type:"GET",dataType:"html"}),t=$(".message-wrap"),e.done(function(e){t.find(".msg-wrap").addClass("hidden"),t.find(".send-wrap").addClass("hidden"),t.prepend(e)})})},notifyNewRoom:function(e){var t,o;t=e.find(".badge"),o=Number(t.text()),t.length?t.text(o+1):e.append('<span class="badge">1</span>')},notifyUsers:function(e){var t;t=$("#users"),t.prepend('<div class="user" id='+e.id+">"+e.name+"</div>")},getConversations:function(e,t,o){var n;return n=$.ajax({url:"/chat/conversations",type:"GET",data:{user_id:e,conversation:t,current_thread:o}})},getMessages:function(e,t){var o;return o=$.ajax({url:"/room/getMessage",type:"GET",data:{user_id:e,conversation:t},dataType:"html"})},sendMessage:function(e,t,o){var n;return n=$.ajax({url:"/room/create-message",type:"POST",data:{body:e,conversation:t,user_id:o},dataType:"json"})},updateConversationCounter:function(e){var t,o;t=e.find(".chat-user-name small .badge"),o=Number(t.text()),t.length?t.text(o+1):e.find(".chat-user-name small").append('<span class="badge">1</span>')},scrollToBottom:function(){var e;e=$(".msg-wrap"),e.length&&e.animate({scrollTop:e[0].scrollHeight},500)},events:function(){var e;e=this,$("#btnSendMessage").on("click",function(t){var o;o=$("#messageBox"),t.preventDefault(),e.sendMessage(o.val(),current_thread,user_id).done(function(e){console.log(e),o.val(""),o.focus()})}),$("#btnNewMessage").on("click",function(){$("#newMessageModal").modal("show")}),$("#messageBox").keypress(function(e){13===e.keyCode&&e.ctrlKey&&(e.preventDefault(),$("#btnSendMessage").trigger("click"))})}},$.ItwayIO.quiz={activate:function(){var e;e=this,e.events()},events:function(){var e,t;e=this,t=$("#quizOptions"),e.addOption(),e.removeOption()},addOption:function(){var e,t;t=$("#quizOptions .options-block:first").clone(),e=1,$("body").on("click",".add_new",function(){var o,n;return e++,o=$("#quizOptions .options-block").length,n=t.clone().find(":input").each(function(){var e;console.log(o),e=this.id+Number(o+1),$(this).prev().attr("for",e).text(o+1),this.id=e}).end().appendTo("#quizOptions"),!1})},removeOption:function(){$("#quizOptions").on("click",".remove",function(){$(this).fadeOut(300,function(){var e,t,o;for($(this).parent().remove(),t=$("#quizOptions .options-block").length,console.log(t),e=0;t>=e;)o="option-id"+Number(e+1),$("#quizOptions .options-block input").eq(e).attr("id",o),$("#quizOptions .options-block i.icon-circle").eq(e).attr("for",o).text(e+1),e++;return!1})})}},$.ItwayIO.layout={activate:function(){var e;e=this,e.fix(),e.fixSidebar(),$(window,".container.wrapper").resize(function(){e.fix(),e.fixSidebar()})},fix:function(){var e,t,o,n,a;t=$("#navigation").outerHeight()+$("#footer").outerHeight(),a=$(window).height(),n=$(".sidebar").height(),$("body").hasClass("fixed")?$(".content-wrapper, .right-side").css("min-height",a-$("#footer").outerHeight()):(o=void 0,a>=n?($(".content-wrapper, .right-side").css("min-height",a-t),o=a-t):($(".content-wrapper, .right-side").css("min-height",n),o=n),e=$($.ItwayIO.options.controlSidebarOptions.selector),"undefined"!=typeof e&&e.height()>o&&$(".content-wrapper, .right-side").css("min-height",e.height()))},fixSidebar:function(){return $("body").hasClass("fixed")?("undefined"==typeof $.fn.slimScroll&&console&&console.error("Error: the fixed layout requires the slimscroll plugin!"),void($.ItwayIO.options.sidebarSlimScroll&&"undefined"!=typeof $.fn.slimScroll&&($(".sidebar").slimScroll({destroy:!0}).height("auto"),$(".sidebar").slimscroll({height:$(window).height()-$("#navigation").height()+"px",color:"rgba(0,0,0,0.2)",size:"3px"})))):void("undefined"!=typeof $.fn.slimScroll&&$(".sidebar").slimScroll({destroy:!0}).height("auto"))}},$.ItwayIO.pushMenu={activate:function(e){var t;t=$.ItwayIO.options.screenSizes,$(e).on("click",function(e){e.preventDefault(),console.log("notifier clicked"),$(window).width()>t.sm-1?$("body").toggleClass("sidebar-collapse"):$("body").hasClass("sidebar-open")?($("body").removeClass("sidebar-open"),$("body").removeClass("sidebar-collapse")):$("body").addClass("sidebar-open")}),$(".content-wrapper").click(function(){$(window).width()<=t.sm-1&&$("body").hasClass("sidebar-open")&&$("body").removeClass("sidebar-open")}),($.ItwayIO.options.sidebarExpandOnHover||$("body").hasClass("fixed")&&$("body").hasClass("sidebar-mini"))&&this.expandOnHover()},expandOnHover:function(){var e,t;e=this,t=$.ItwayIO.options.screenSizes.sm-1,$(".main-sidebar").hover(function(){$("body").hasClass("sidebar-mini")&&$("body").hasClass("sidebar-collapse")&&$(window).width()>t&&e.expand()},function(){$("body").hasClass("sidebar-mini")&&$("body").hasClass("sidebar-expanded-on-hover")&&$(window).width()>t&&e.collapse()})},expand:function(){$("body").removeClass("sidebar-collapse").addClass("sidebar-expanded-on-hover")},collapse:function(){$("body").hasClass("sidebar-expanded-on-hover")&&$("body").removeClass("sidebar-expanded-on-hover").addClass("sidebar-collapse")}},$.ItwayIO.tree=function(e){var t;t=this,$("li a",$(e)).on("click",function(e){var o,n,a,s,i;o=$(this),n=o.next(),n.is(".treeview-menu")&&n.is(":visible")?(n.slideUp("normal",function(){n.removeClass("menu-open")}),n.parent("li").removeClass("active")):n.is(".treeview-menu")&&!n.is(":visible")&&(a=o.parents("ul").first(),i=a.find("ul:visible").slideUp("normal"),i.removeClass("menu-open"),s=o.parent("li"),n.slideDown("normal",function(){n.addClass("menu-open"),a.find("li.active").removeClass("active"),s.addClass("active"),t.layout.fix()})),n.is(".treeview-menu")&&e.preventDefault()})},$.ItwayIO.controlSidebar={activate:function(){var t,o,n,a;t=this,e=$.ItwayIO.options.controlSidebarOptions,a=$(e.selector),n=$(e.toggleBtnSelector),n.on("click",function(o){o.preventDefault(),a.hasClass("control-sidebar-open")||$("body").hasClass("control-sidebar-open")?(t.close(a,e.slide),$(this).removeClass("active")):(t.open(a,e.slide),$(this).addClass("active"))}),o=$(".control-sidebar-bg"),t._fix(o),$("body").hasClass("fixed")?t._fixForFixed(a):$(".content-wrapper, .right-side").height()<a.height()&&t._fixForContent(a)},open:function(e,t){var o;o=this,t?e.addClass("control-sidebar-open"):$("body").addClass("control-sidebar-open")},close:function(e,t){t?e.removeClass("control-sidebar-open"):$("body").removeClass("control-sidebar-open")},_fix:function(e){var t,o;t=this,o=$("#navigation").outerHeight(),$("body").hasClass("layout-boxed")?(e.css("position","absolute"),e.height($(window).height()/2-o).css({"overflow-y":"auto"}),$(window).resize(function(){t._fix(e)})):e.css({position:"fixed",height:"auto"})},_fixForFixed:function(e){e.css({position:"fixed","max-height":"100%",overflow:"auto","padding-bottom":"50px"})},_fixForContent:function(e){$(".content-wrapper, .right-side").css("min-height",e.height())}},$.ItwayIO.boxWidget={selectors:$.ItwayIO.options.boxWidgetOptions.boxWidgetSelectors,icons:$.ItwayIO.options.boxWidgetOptions.boxWidgetIcons,activate:function(){var e;e=this,$(e.selectors.collapse).on("click",function(t){t.preventDefault(),e.collapse($(this))}),$(e.selectors.remove).on("click",function(t){t.preventDefault(),e.remove($(this))})},collapse:function(e){var t,o,n;t=this,o=e.parents(".box").first(),n=o.find("> .box-body, > .box-footer"),o.hasClass("collapsed-box")?(e.children(":first").removeClass(t.icons.open).addClass(t.icons.collapse),n.slideDown(300,function(){o.removeClass("collapsed-box")})):(e.children(":first").removeClass(t.icons.collapse).addClass(t.icons.open),n.slideUp(300,function(){o.addClass("collapsed-box")}))},remove:function(e){var t;t=e.parents(".box").first(),t.slideUp()}}},"undefined"==typeof jQuery)throw new Error("ItwayIO requires jQuery");$.ItwayIO={},$.ItwayIO.options={host:"http://"+window.location.hostname,socket:io("http://www.itway.io:6378"),navbarMenuSlimscroll:!0,navbarMenuSlimscrollWidth:"3px",navbarMenuHeight:"200px",sidebarControlWidth:"280px",sidebarToggleSelector:"[data-toggle='offcanvas']",sidebarPushMenu:!0,sidebarSlimScroll:!1,sidebarExpandOnHover:!0,enableBoxRefresh:!0,enableBSToppltip:!0,BSTooltipSelector:"[data-toggle='tooltip']",enableFastclick:!0,enableControlSidebar:!0,controlSidebarOptions:{toggleBtnSelector:"[data-toggle='control-sidebar']",selector:".control-sidebar",slide:!0},enableBoxWidget:!0,boxWidgetOptions:{boxWidgetIcons:{collapse:"fa-minus",open:"fa-plus",remove:"fa-times"},boxWidgetSelectors:{remove:'[data-widget="remove"]',collapse:'[data-widget="collapse"]'}},directChat:{enable:!0,contactToggleSelector:'[data-widget="chat-pane-toggle"]'},search:{searchBTN:$("#search button"),searchResult:$(".search-result")},colors:{lightBlue:"#3c8dbc",red:"#f56954",green:"#00a65a",aqua:"#00c0ef",yellow:"#f39c12",blue:"#0073b7",navy:"#001F3F",teal:"#39CCCC",olive:"#3D9970",lime:"#01FF70",orange:"#FF851B",fuchsia:"#F012BE",purple:"#8E24AA",maroon:"#D81B60",black:"#222222",gray:"#d2d6de"},screenSizes:{xs:480,sm:768,md:992,lg:1200}},$(function(){var t;"undefined"!=typeof ItwayIOOptions&&$.extend(!0,$.ItwayIO.options,ItwayIOOptions),t=$.ItwayIO.options,e(t),$.ItwayIO.csrf.activate(),$.ItwayIO.search.activate(),$.ItwayIO.notifier.activate(),$.ItwayIO.layout.activate(),$.ItwayIO.messenger.activate(),$.ItwayIO.quiz.activate(),"undefined"!==(typeof buttonID&&typeof base_url&&typeof class_name&&typeof object_id&&typeof redirectIFerror)&&$.ItwayIO.likeBTN.activate(buttonID,base_url,class_name,object_id,redirectIFerror),$.ItwayIO.imageLoad.activate(),$.ItwayIO.tree(".sidebar"),t.enableControlSidebar&&$.ItwayIO.controlSidebar.activate(),t.navbarMenuSlimscroll&&"undefined"!=typeof $.fn.slimscroll&&$(".navbar .menu").slimscroll({height:t.navbarMenuHeight,alwaysVisible:!1,size:t.navbarMenuSlimscrollWidth}).css("width","100%"),t.sidebarPushMenu&&$.ItwayIO.pushMenu.activate(t.sidebarToggleSelector),t.enableBoxWidget&&$.ItwayIO.boxWidget.activate(),t.enableFastclick&&"undefined"!=typeof FastClick&&FastClick.attach(document.body),t.directChat.enable&&$(t.directChat.contactToggleSelector).on("click",function(){var e;e=$(this).parents(".direct-chat").first(),e.toggleClass("direct-chat-contacts-open")}),$('.button-group[data-toggle="btn-toggle"]').each(function(){var e;e=$(this),$(this).find(".button").on("click",function(t){e.find(".button.active").removeClass("active"),$(this).addClass("active"),t.preventDefault()})})})}).call(this);