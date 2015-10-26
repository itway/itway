@if (\Auth::user())
    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
        <li><a href="{{ route('admin::index') }}">{{ trans('navigation.Admin') }}</a></li>
    @endif
@endif