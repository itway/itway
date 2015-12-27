@include('includes.head')
<body class="layout-boxed sidebar-mini skin-black">
@include('includes.navigation')
@yield('subnav')
@if(URL::current() === 'http://'.$_SERVER['SERVER_NAME'].'/'.Lang::getLocale())
    @include('pages.landing')
@else
    @include('includes.search')
    <div class="container wrapper">
        <div class="content-wrapper">
            <div>
                @include('includes.site-location')
            </div>
            @endif
            <div class="clearfix"></div>
            <div id="container" class="container-fluid" style=" ">
                <div class="l-9 m-8 s-12 xs-12" style="padding-left: 0;">
                    @include('flash::message')
                    @include('includes.errors')

                    @yield('content')

                </div>
                @if(URL::current() !== 'http://'.$_SERVER['SERVER_NAME'].'/'.Lang::getLocale())
                    <div class="l-3 m-4 hidden-s hidden-xs" style="padding-right: 0">
                        <div class="row">
                            <div class="sidebar">

                                @include('includes.sidebar')

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('includes.footer')
    {{--@include('includes.bottom-navigation')--}}
</body>
</html>