@if (\Auth::user())
    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
        <a class="item" href="{{ route('admin::index') }}">{{ trans('navigation.Admin') }}</a>
    @endif
@endif