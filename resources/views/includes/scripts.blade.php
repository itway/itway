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

<script src="{{ asset('dist/vendor/jquery/dist/jquery.min.js') }}"></script>
<script  src="{{asset('/dist/vendor/tooltipster/js/jquery.tooltipster.min.js')}}"></script>
<script src="{{asset('vendor/highlight.pack.js')}}"></script>

<script src="{{ asset('dist/js/modules/modules.min.js') }}"></script>
<script src="{{ asset('dist/vendor/taggingJS/tagging.js') }}"></script>
<script src="{{ asset('dist/vendor/jquery-simply-countable/jquery.simplyCountable.js') }}"></script>
<script src="{{asset('dist/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/vendor/socket.io-client/socket.io.js') }}"></script>
<script src="{{asset('dist\semantic\dist\components\api.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\transition.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\dropdown.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\form.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\tab.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\checkbox.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\modal.min.js')}}"></script>
<script src="{{asset('dist\semantic\dist\components\dimmer.min.js')}}"></script>
<script src="{{ asset('/dist/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/js/modules/modules.min.js') }}"></script>


<script>hljs.initHighlightingOnLoad();</script>
<script>

    $('.navigation .ui.dropdown')
            .dropdown({
                on: 'hover'
            })
    ;
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
    $('.ui.inline.dropdown').dropdown();
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
    $('.error .close').click(function(e) {
        e.preventDefault();
        $(this).closest('.error').animate({
            opacity: 0.25,
            left: "+=50",
             height: "toggle"
         }, 100);
    });

    var user_id   = "@if(Auth::check()){!! Auth::user()->id !!}@else null @endif";

</script>

        {!! Toastr::render() !!}
        {!! Toastr::clear() !!}

@yield('scripts-add')