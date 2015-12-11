<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-68942724-1', 'auto');
    ga('send', 'pageview');
    @if (Auth::user())
    ga('set', '&uid',{{Auth::user()->id}});
    @endif
</script>

<script src="{{ asset('dist/vendor/taggingJS/tagging.js') }}"></script>
<script src="{{ asset('dist/vendor/jquery-simply-countable/jquery.simplyCountable.js') }}"></script>
<script src="{{asset('dist/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/vendor/socket.io-client/socket.io.js') }}"></script>
<script src="{{ asset('dist/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('dist/vendor/underscore/underscore-min.js') }}"></script>
<script src="{{ asset('dist/vendor/kreate.js/dist/kreate.min.js') }}"></script>
<script src="{{asset('dist\semantic\dist\components\api.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\transition.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\visibility.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\dropdown.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\form.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\tab.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\checkbox.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\dimmer.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\nag.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\search.js')}}"></script>
<script src="{{asset("dist/vendor/remodal/dist/remodal.min.js")}}"></script>
<script src="{{asset("dist/vendor/pickadate/lib/compressed/picker.js")}}"></script>
<script src="{{asset("dist/vendor/pickadate/lib/compressed/picker.date.js")}}"></script>
<script src="{{ asset('/dist/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/js/modules/modules.min.js') }}"></script>


<script>

    $('.cookie.nag')
            .nag('clear')
    ;
    $('.cookie.nag')
            .nag('show')
    ;
    $('.special.cards .image').dimmer({
        on: 'hover'
    });
    $('.message .close')
            .on('click', function() {
                $(this)
                        .closest('.message')
                        .transition('fade')
                ;
            })
    ;
    // Clears cookie so nag shows again

    var photo = $(".photo"),
        githubLink = $(".github-link"),
        poll = $(".poll"),
        youtube = $(".youtube");

    // photo.click(function(){
    //   $('.ui.modal.image-modal')
    //     .modal({
    //       blurring: true
    //     })
    //     .modal('show');
    // });
    // githubLink.click(function(){
    //   $('.ui.modal.github-modal')
    //     .modal({
    //       blurring: true
    //     })
    //     .modal('show');
    // });
    // poll.click(function(){
    //   $('.ui.modal.poll-modal')
    //     .modal({
    //       blurring: true
    //     })
    //     .modal('show');
    // });
    // youtube.click(function(){
    //   $('.ui.modal.youtube-modal')
    //     .modal({
    //       blurring: true
    //     })
    //     .modal('show');
    // });
    $('.navigation .ui.dropdown')
            .dropdown({
                on: 'hover'
            });
    $('.ui.vertical.menu .ui.dropdown')
            .dropdown({
                on: 'hover'
            })
    ;
    $('.ui.dropdown.item.pointing')
            .dropdown()
    ;
    $('.ui.dropdown.item')
            .dropdown()
    ;
    var drop = $('.ui.inline.dropdown');
    drop.dropdown({transition: 'drop'});
    var cloned = drop.find('.item.block.active.selected').clone();
    drop.find('.text').html(cloned.html());
    $('.ui.floating.labeled.icon.dropdown.button').dropdown();
    $('.menu .item')
            .tab()
    ;
$('.notification .close').click(function(e) {
        e.preventDefault();
        $(this).closest('.notification').animate({
            opacity: 0.25,
            left: "+=50",
             height: "toggle"
         }, 100);
    });
//
//    $('.error .close').click(function(e) {
//        e.preventDefault();
//        $(this).closest('.error').animate({
//            opacity: 0.25,
//            left: "+=50",
//             height: "toggle"
//         }, 100);
//    });

    var user_id   = "@if(Auth::check()){!! Auth::user()->id !!}@else null @endif";

</script>

        {!! Toastr::render() !!}
        {!! Toastr::clear() !!}

@yield('scripts-add')
