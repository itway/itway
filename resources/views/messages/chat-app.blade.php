@include('includes.head')
<body class="layout-boxed sidebar-mini skin-black">

@include('includes.navigation')


<div class="container wrapper">
    <div class="content-wrapper">
        @include('includes.notifier-panel')
        {{--<div class="container-fluid">--}}
        {{--@include('includes.subnavigation')--}}
        {{--</div>--}}

        <div>
            @include('includes.site-location')
        </div>
        <div class="clearfix"></div>

        <div class="container site-buttons">

            {{--@yield('site-btns')--}}
        </div>
        @include('includes.search')

        <div id="container" class="container" style=" ">

            <div class="l-12 m-12 s-12 xs-12" style="padding-left: 0;">

                @include('flash::message')
                @include('includes.errors')
                @yield('content')
            </div>

        </div>

    </div>
</div>

@include('includes.footer')
@include('includes.bottom-navigation')

</body>
</html>