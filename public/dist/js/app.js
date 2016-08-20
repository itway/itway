(function(){var e;if(e=function(e){var t;$.ItwayIO.csrf={activate:function(){return $.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}})}},$.ItwayIO.blog={activate:function(){var e;return e=this}},t=void 0,$.ItwayIO.search={selectors:$.ItwayIO.options.search,activate:function(){var e,t,a;e=this,t=this.selectors.searchBTN,a=this.selectors.searchResult,t.click(function(t){t.preventDefault(),e.search()}),$(".tag-search").on("click",function(t){t.preventDefault(),e.tagSearch()}),$("a.search-button").on("click",function(e){e.preventDefault(),$('#search input[type="search"]').focus(),$("#search").addClass("active"),$("body").css({overflow:"hidden"})}),$("#search, #search button.close").on("click keyup",function(t){(t.target===this||"close"===t.target.className||"icon-close"===t.target.className||27===t.keyCode)&&($(this).removeClass("active"),a.html(""),$("#search .search-input").val(""),$("body").css({overflow:"auto"}),e.stopSearch())}),$("#search form").submit(function(e){return e.preventDefault(),!1}),$('#search > form > input[type="search"]').keyup(function(t){13===t.keyCode&&$("#search .search-input").val().length>0||$("#search .search-input").val().length>0?e.search():e.stopSearch()})},search:function(){var e,a;e=this,a=this.selectors.searchResult,t=setTimeout(function(){$.ajax({url:APP_URL+"/search",data:{keywords:$("#search .search-input").val()},method:"post",success:function(e){a.html(e)},error:function(t){a.html('<h3 class="text-danger"> try once more... </h3>'),console.log(t.type),e.stopSearch()}})},500)},tagSearch:function(){var e,a;e=this,a=this.selectors.searchResult,t=setTimeout(function(){$.ajax({url:APP_URL+"/getAllExistingTags",method:"post",success:function(e){a.html(e)},error:function(t){a.html('<h3 class="text-danger"> try once more... </h3>'),console.log(t.type),e.stopSearch()}})},500)},stopSearch:function(){clearTimeout(t)}},$.ItwayIO.imageLoad={activate:function(){var e;e=this,e.initiateInstanceImage(),e.initiateProfileImage()},renderInstanceImage:function(e,t,a){var n,o,s;n=this,s=new FileReader,o=new Image,s.onload=function(s){o.src=s.target.result,o.onload=function(){var t,s,i,r,l,c;c=this.width,t=this.height,l=e.type,s=e.name,i=~~(e.size/1024)/1024,r=a.thumbnail_size,$(".p").append("<div class='s-12 m-12 l-12 xs-12'><div class='thumbnail' style='background: #ffffff'><img class=\"img-responsive\" src='"+o.src+"' /><div class='caption' style='position: absolute;right: 10px;top:10px;'> <h4  style='background: black;padding: 4px; color: white'>"+i.toFixed(2)+" Mb </h4></div></div> </div> "),n.renderLabelFileName(s,"success")},o.onerror=function(){alert("Invalid file type: "+e.type),n.renderLabelFileName(e.name,"error"),t.val(null)}},s.readAsDataURL(e)},renderProfileImage:function(e,t,a){var n,o,s;n=this,s=new FileReader,o=new Image,s.onload=function(s){o.src=s.target.result,o.onload=function(){var t,s,i,r,l,c;c=this.width,t=this.height,l=e.type,s=e.name,i=~~(e.size/1024)/1024,r=a.thumbnail_size,$(".profile-img").attr("src",o.src).css({position:"relative"}),n.renderLabelFileProfile(s,"success"),n.downButton("success")},o.onerror=function(){alert("Invalid file type: "+e.type),n.renderLabelFileProfile(e.name,e.type),n.downButton("error"),t.val(null)}},s.readAsDataURL(e)},downButton:function(e){var t,a;return t=this,a=$("#upload-button"),a.removeClass("text-info"),a.removeClass("text-danger"),"success"===e?(a.removeClass("hidden"),a.addClass("block"),a.val("to download press").addClass("text-info")):(a.addClass("hidden"),a.removeClass("block"),a.addClass("text-danger"),a.val("wrong file format"),a.bind("click",function(e){return e.preventDefault(),$(this).unbind(e)}))},renderLabelFileName:function(e,t){var a,n;return a=this,n=$(".filelabel"),(n.find("span.text-info").length>0||n.find("span.text-danger").length>0)&&(n.find("span.text-info").remove(),n.find("span.text-danger").remove()),$(".filelabel").append("success"===t?$("<span>").addClass("text-info").css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}):$("<span>").addClass("text-danger").text(" format is not valid").css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}))},renderLabelFileProfile:function(e,t){var a,n,o;return n=this,o=$(".label"),a=$(".profile-img"),(a.next("span.text-info").length>0||a.next("span.text-danger").length>0)&&(console.log(a.next()),a.next("span.text-info").remove(),a.next("span.text-danger").remove()),a.after("success"===t?$("<span>").addClass("text-info").css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}):$("<span>").addClass("text-danger").html("<br/><b>format is not valid </b>").css({"font-size":"100%",display:"inline-block","font-weight":"normal","margin-left":"1em","font-style":"normal"}))},initiateInstanceImage:function(){var e,t,a;e=this,t=$("#fileupload").attr("accept","image/jpeg,image/png,image/gif"),a={thumbnail_size:460,thumbnail_bg_color:"#ddd",thumbnail_border:"1px solid #fff",thumbnail_shadow:"0 0 0px rgba(0, 0, 0, 0.5)",label_text:"",warning_message:"Not an image file.",warning_text_color:"#f00",input_class:"custom-file-input button button-primary button-block"},t.change(function(){var n,o;if($(".p").html(""),this.disabled)return alert("File upload not supported!");if(n=this.files,n&&n[0])for(o=0;o<n.length;)n[o].type.match("image.*")?e.renderInstanceImage(n[o],t,a):e.renderLabelFileName(n[o].name,"error"),o++})},initiateProfileImage:function(){var e,t,a;e=this,t=$("#file").attr("accept","image/jpeg,image/png,image/gif"),a={thumbnail_size:100,thumbnail_bg_color:"#ddd",thumbnail_border:"3px solid white",thumbnail_border_radius:"3px",label_text:"",warning_message:"Not an image file.",warning_text_color:"#f00",input_class:"custom-file-input button button-primary button-block"},t.change(function(){var n,o;if($(".profile-img-block").html(""),this.disabled)return alert("File upload not supported!");if(n=this.files,n&&n[0])for(o=0;o<n.length;)n[o].type.match("image.*")?(e.renderProfileImage(n[o],t,a),e.renderLabelFileProfile(n[o].name,"success")):(e.renderLabelFileProfile(n[o].name,"error"),e.downButton("error"),t.val(null)),o++})}},$.ItwayIO.messenger={activate:function(){var t,a;t=this,t.scrollToBottom(),t.noRoom(),t.createNewRoom(),e.socket.on("chat-connected:itway\\Events\\UserEnteredChatEvent",function(){}),a=$.ajax({url:"/chat/"+user_id+"/rooms",type:"GET",dataType:"json"}),a.done(function(t){t.success&&t.result.length>0&&(console.log(t.result),$.each(t.result,function(t,a){e.socket.emit("join",{room:a.id})}))}),e.socket.on("welcome",function(t){console.log(t.message),e.socket.emit("join",{room:current_thread})}),e.socket.on("joined",function(e){console.log(e.message)}),e.socket.on("userCount",function(e){var t;t=$("#chatRightPanel"),$("#chatRightPanel .numUsers").length>=1?(t.find("small.numUsers").remove(),t.append('<small class="numUsers">online users count '+e.userCount+"</small>")):t.append('<small class="numUsers">online users count '+e.userCount+"</small>")}),e.socket.on("userJoined",function(e){var t,a;a=$("#users"),t=$(".message-wrap"),a.find(".media-body .online").remove(),a.removeClass("active"),t.find(".comment .online").remove(),$.each(e.users,function(e,n){var o,s;s=a.find("a[data-userid='"+n.customId+"']"),o=t.find(".comment[data-comment-user='"+n.customId+"']"),s.addClass("active"),s.find(".media-body").append('<span class="online"></span>'),o.append('<span class="online">online</span>')})}),e.socket.on("connect",function(t){e.socket.emit("storeClientInfo",{customId:user_id}),console.log(t)}),e.socket.on("chat.messages:itway\\Events\\ChatMessageCreated",function(e){var a,n,o,s,i;s=e.data,n=$(".msg-wrap .comments"),a=$(".conversation-wrap a[data-room='"+s.room+"']"),e=s.message.body,i=s.message.user_id,o=s.room,t.getMessages(i,o).done(function(s){a.find(".last-message-body").text(e),o===current_thread&&(n.append(s),t.scrollToBottom()),i!==user_id&&o!==current_thread&&t.updateConversationCounter(a)})}),e.socket.on("chat.rooms:itway\\Events\\ChatRoomCreated",function(e){var a,n,o,s,i,r;a=$(".rooms .conversation-wrap"),i=e.data,o=$(".msg-wrap .comments"),n=$(".button-panel-conversation a[data-tab='rooms']"),e=i.message.body,r=i.message.user_id,s=i.room,t.getConversations(user_id,s,current_thread).done(function(e){var o;e.notInRoom||(a.prepend(e),o=$(".conversation-wrap a[data-room='"+s+"']"),t.notifyNewRoom(n),t.updateConversationCounter(o))})}),t.events()},noRoom:function(){var e,t;t=$("#no-room"),e=$("#create-room"),t.length>=1&&(t.addClass("hidden"),e.on("click",function(e){e.preventDefault(),t.removeClass("hidden").addClass("active")}))},createNewRoom:function(){$("#chatDropdown").dropdown({onChange:function(e,t,a){console.log(e,t,a)},transition:"drop"}),$("#create-room").on("click",function(){var e,t;e=$.ajax({url:"/chat/create",type:"GET",dataType:"html"}),t=$(".message-wrap"),e.done(function(e){t.find(".msg-wrap").addClass("hidden"),t.find(".send-wrap").addClass("hidden"),t.prepend(e)})})},notifyNewRoom:function(e){var t,a;t=e.find(".badge"),a=Number(t.text()),t.length?t.text(a+1):e.append('<span class="badge">1</span>')},notifyUsers:function(e){var t;t=$("#users"),t.prepend('<div class="user" id='+e.id+">"+e.name+"</div>")},getConversations:function(e,t,a){var n;return n=$.ajax({url:"/chat/conversations",type:"GET",data:{user_id:e,conversation:t,current_thread:a}})},getMessages:function(e,t){var a;return a=$.ajax({url:"/room/getMessage",type:"GET",data:{user_id:e,conversation:t},dataType:"html"})},sendMessage:function(e,t,a){var n;return n=$.ajax({url:"/room/create-message",type:"POST",data:{body:e,conversation:t,user_id:a},dataType:"json"})},updateConversationCounter:function(e){var t,a;t=e.find(".chat-user-name small .badge"),a=Number(t.text()),t.length?t.text(a+1):e.find(".chat-user-name small").append('<span class="badge">1</span>')},scrollToBottom:function(){var e;e=$(".msg-wrap"),e.length&&e.animate({scrollTop:e[0].scrollHeight},500)},events:function(){var e;e=this,$("#btnSendMessage").on("click",function(t){var a;a=$("#messageBox"),t.preventDefault(),e.sendMessage(a.val(),current_thread,user_id).done(function(e){console.log(e),a.val(""),a.focus()})}),$("#btnNewMessage").on("click",function(){$("#newMessageModal").modal("show")}),$("#messageBox").keypress(function(e){13===e.keyCode&&e.ctrlKey&&(e.preventDefault(),$("#btnSendMessage").trigger("click"))})}},$.ItwayIO.tree=function(e){var t;t=this,$("li a",$(e)).on("click",function(e){var a,n,o,s,i;a=$(this),n=a.next(),n.is(".treeview-menu")&&n.is(":visible")?(n.slideUp("normal",function(){n.removeClass("menu-open")}),n.parent("li").removeClass("active")):n.is(".treeview-menu")&&!n.is(":visible")&&(o=a.parents("ul").first(),i=o.find("ul:visible").slideUp("normal"),i.removeClass("menu-open"),s=a.parent("li"),n.slideDown("normal",function(){n.addClass("menu-open"),o.find("li.active").removeClass("active"),s.addClass("active"),t.layout.fix()})),n.is(".treeview-menu")&&e.preventDefault()})},$.ItwayIO.boxWidget={selectors:$.ItwayIO.options.boxWidgetOptions.boxWidgetSelectors,icons:$.ItwayIO.options.boxWidgetOptions.boxWidgetIcons,activate:function(){var e;e=this,$(e.selectors.collapse).on("click",function(t){t.preventDefault(),e.collapse($(this))}),$(e.selectors.remove).on("click",function(t){t.preventDefault(),e.remove($(this))})},collapse:function(e){var t,a,n;t=this,a=e.parents(".box").first(),n=a.find("> .box-body, > .box-footer"),a.hasClass("collapsed-box")?(e.children(":first").removeClass(t.icons.open).addClass(t.icons.collapse),n.slideDown(300,function(){a.removeClass("collapsed-box")})):(e.children(":first").removeClass(t.icons.collapse).addClass(t.icons.open),n.slideUp(300,function(){a.addClass("collapsed-box")}))},remove:function(e){var t;t=e.parents(".box").first(),t.slideUp()}}},"undefined"==typeof jQuery)throw new Error("ItwayIO requires jQuery");$.ItwayIO={},$.ItwayIO.options={host:"http://"+window.location.hostname,socket:io(APP_URL+":6378"),navbarMenuSlimscroll:!0,navbarMenuSlimscrollWidth:"3px",navbarMenuHeight:"200px",sidebarControlWidth:"280px",sidebarToggleSelector:"[data-toggle='offcanvas']",sidebarPushMenu:!0,sidebarSlimScroll:!1,sidebarExpandOnHover:!0,enableBoxRefresh:!0,enableBSToppltip:!0,BSTooltipSelector:"[data-toggle='tooltip']",enableFastclick:!0,enableControlSidebar:!0,controlSidebarOptions:{toggleBtnSelector:"[data-toggle='control-sidebar']",selector:".control-sidebar",slide:!0},enableBoxWidget:!0,boxWidgetOptions:{boxWidgetIcons:{collapse:"fa-minus",open:"fa-plus",remove:"fa-times"},boxWidgetSelectors:{remove:'[data-widget="remove"]',collapse:'[data-widget="collapse"]'}},directChat:{enable:!0,contactToggleSelector:'[data-widget="chat-pane-toggle"]'},search:{searchBTN:$("#search button"),searchResult:$(".search-result #search-result-body")},colors:{lightBlue:"#3c8dbc",red:"#f56954",green:"#00a65a",aqua:"#00c0ef",yellow:"#f39c12",blue:"#0073b7",navy:"#001F3F",teal:"#39CCCC",olive:"#3D9970",lime:"#01FF70",orange:"#FF851B",fuchsia:"#F012BE",purple:"#8E24AA",maroon:"#D81B60",black:"#222222",gray:"#d2d6de"},screenSizes:{xs:480,sm:768,md:992,lg:1200}},$(function(){var t;"undefined"!=typeof ItwayIOOptions&&$.extend(!0,$.ItwayIO.options,ItwayIOOptions),t=$.ItwayIO.options,e(t),$.ItwayIO.csrf.activate(),$.ItwayIO.search.activate(),$.ItwayIO.messenger.activate(),$.ItwayIO.imageLoad.activate(),t.navbarMenuSlimscroll&&"undefined"!=typeof $.fn.slimscroll&&$(".navbar .menu").slimscroll({height:t.navbarMenuHeight,alwaysVisible:!1,size:t.navbarMenuSlimscrollWidth}).css("width","100%"),t.enableBoxWidget&&$.ItwayIO.boxWidget.activate(),t.enableFastclick&&"undefined"!=typeof FastClick&&FastClick.attach(document.body),t.directChat.enable&&$(t.directChat.contactToggleSelector).on("click",function(){var e;e=$(this).parents(".direct-chat").first(),e.toggleClass("direct-chat-contacts-open")}),$('.button-group[data-toggle="btn-toggle"]').each(function(){var e;e=$(this),$(this).find(".button").on("click",function(t){e.find(".button.active").removeClass("active"),$(this).addClass("active"),t.preventDefault()})})})}).call(this);