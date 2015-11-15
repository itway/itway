

    {{--<button type="button" class="close">--}}
        {{--<span aria-hidden="true">x</span>--}}
    {{--</button>--}}

@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
            <div class="ui {{ Session::get('flash_notification.level') }} message">
                <i class="close icon icon-close"></i>
                <p>{{ Session::get('flash_notification.message') }}</p>

            </div>
    @endif
    <div class="hidden">
        {{Session::remove('flash_notification.message')}}
        {{Session::remove('flash_notification.level')}}
    </div>
    @endif


