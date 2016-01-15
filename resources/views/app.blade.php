@include('includes.head')
<body class="layout-boxed sidebar-mini skin-black">
@include('includes.navigation')
@yield('subnav')
@include('includes.search')
<div class="container wrapper">
    <div class="content-wrapper">
        <div>
            @include('includes.site-location')
        </div>
        <div class="clearfix"></div>
        <div id="container" class="container-fluid" style=" ">
            <div class="l-9 m-12 s-12 xs-12" style="padding-left: 0;">
                @include('flash::message')
                @include('includes.errors')
                @yield('content')
            </div>
            <div class="l-3 m-4 hidden-m hidden-s hidden-xs" style="padding-right: 0">
                <div class="row">
                    <div class="sidebar">
                        @yield('sidebar-add')
                        @include('includes.sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
{{--@include('includes.bottom-navigation')--}}
</body>
</html>