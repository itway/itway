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
            <div class="l-12 m-12 s-12 xs-12" style="padding-left: 0;">
                @include('flash::message')
                @include('includes.errors')
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
</body>
</html>
