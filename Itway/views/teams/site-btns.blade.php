<a class="item" href="#create-team" > <i class="icon-pencil"></i> {{ trans('navigation.Create-Team') }}</a>
@include('create-form.teamCreate-modal', [$model = isset($team) ? $team : null])
<a class="item" href="{{ url(App::getLocale().'/teams/') }}" ><i class="icon-layers"></i> {{ trans('navigation.User-Team') }} <div class="ui blue tiny label"></div></a>
