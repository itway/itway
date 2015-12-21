<a class="item" href="#create-openidea" > <i class="icon-pencil"></i> {{ trans('navigation.Create-Team') }}</a>
@include('create-form.openideaCreate-modal', [$model = isset($openidea) ? $openidea : null])
<a class="item" href="{{ url(App::getLocale().'/openideas/') }}" ><i class="icon-layers"></i> {{ trans('navigation.User-Team') }} <div class="ui blue tiny label"></div></a>
