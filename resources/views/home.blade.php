@include('includes.head')
<body class="layout-boxed sidebar-mini skin-black">
@include('includes.navigation')
@yield('subnav')
@include('pages.landing')
<div class="clearfix"></div>
<div id="container" class="container-fluid" style=" ">
    <div class="l-9 m-12 s-12 xs-12" style="padding-left: 0;">
        @include('flash::message')
        @include('includes.errors')
        @yield('content')
    </div>
</div>
@include('includes.footer')
{{--@include('includes.bottom-navigation')--}}
</body>
</html>