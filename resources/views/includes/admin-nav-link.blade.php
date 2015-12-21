@if (\Auth::user())
    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
        <a class="item" href="{{ route('admin::index') }}"><i class="icon-code"></i> {{ trans('navigation.Admin') }}</a>
    @endif
@endif