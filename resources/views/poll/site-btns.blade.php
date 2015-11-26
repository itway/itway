        <a class="item" href="{{ url(App::getLocale().'/poll/create') }}" ><i class="icon-pencil"></i> {{ trans('poll.create') }}</a>
        <a class="item" href="{{ url(App::getLocale().'/poll/personal_polls') }}" ><i class="icon-list-alt"></i> {{ trans('poll.your_poll') }} <div class="ui blue tiny label">{{$countUserPolls}}</div></a>
