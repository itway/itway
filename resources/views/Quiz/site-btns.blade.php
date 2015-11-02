    @if( Route::currentRouteName('quiz'))
        <li><a class="button button-transparent-white" href="{{ url(App::getLocale().'/quiz/create') }}" ><i class="icon-pencil"></i> {{ trans('quiz.create') }}</a></li>
        <li><a class="button button-transparent-white" href="{{ url(App::getLocale().'/quiz/personal_quizzes') }}" ><i class="icon-list-alt"></i> {{ trans('quiz.your_quizzes') }} {{$countUserQuizzes}}</a></li>
    @endif
