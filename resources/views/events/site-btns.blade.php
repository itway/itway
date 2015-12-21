<a class="item" href="#create-event" > <i class="icon-pencil"></i> {{ trans('navigation.Create-Event') }}</a>
@include('create-form.eventCreate-modal', [$model = isset($event) ? $event : null])
<a class="item" href="{{ url(App::getLocale().'/events/') }}" ><i class="icon-layers"></i> {{ trans('navigation.User-Event') }} <div class="ui blue tiny label"></div></a>
