        <a class="item" href="{{ url(App::getLocale().'/quiz/create') }}" ><i class="icon-pencil"></i> {{ trans('quiz.create') }}</a>
        <a class="item" href="{{ url(App::getLocale().'/quiz/personal_quizzes') }}" ><i class="icon-list-alt"></i> {{ trans('quiz.your_quizzes') }} {{$countUserQuizzes}}</a>
