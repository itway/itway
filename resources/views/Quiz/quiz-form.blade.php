<div class="l-12 m-12 s-12">
    <h3 class="label titl">{{trans('quiz.name')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'input input-line', 'id' => 'name','placeholder' => 'insert your title here      (max:120)'])!!}
    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="counter1"></span> symbols.</div>
    </div>
    <h3 class="label titl">{{trans('quiz.question')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::textarea('question', null, ['class' => 'input input-line', 'id' => 'question','rows' => '3', 'placeholder' => 'insert your preamble here      (max:300)'])!!}
    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="counter2"></span> symbols.</div>
    </div>

    <div class="quiz-form-block">

        <h3 class="label titl">{{trans('quiz.options')}}</h3>
        <div class="form-group" style="display: block" id="quizOptions">

        <div class="options-block">
            <i class="icon-circle">1</i>
            <input name="options[]" id="option-id1" type="text" class="input input-line">
            <a class="button remove" data-action="delete"><i class="icon-minus text-danger"></i></a>
            <a class="button add_new" data-action="add"><i class="icon-plus"></i></a>
        </div>


        </div>
    </div>
    <h3 class="label">{{trans('quiz.publish_on')}}</h3>
    <div class="clearfix"></div>
    @if(isset($quizInstance))
        <div class="form-group">
            {!! Form::input('date', 'published_at', $quizInstance->published_at ?  explode(" ",$quizInstance->published_at)[0]: date('Y-m-d') , ['class'=> 'input input-line'])!!}
        </div>
    @else
        <div class="form-group">
            {!! Form::input('date', 'published_at', $quiz->published_at ? explode(" ", $quiz->published_at)[0] : date('Y-m-d') , ['class'=> 'input input-line'])!!}
        </div>
    @endif
    <h3 class="label">{{trans('quiz.tags')}}</h3>
    <div class="clearfix"></div>

    <div class="form-group">
        <div data-tags-input-name="tags_list" id="tagBox" ></div>
    </div>
    <h3 class="label titl">{{trans('quiz.img')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        <label for="fileupload" class="filelabel custom-file-input button button-primary button-block">
        <i class="icon-file_download"></i>
        </label>


        @if(isset($picture))
            @foreach($picture as $pic)
                {{--{{ dd($pic) }}--}}
                {!! Form::file('image', ['id' => 'fileupload' ,'value'=>"'images/quizzes/'.$pic->path",'class' => 'file-input',  'placeholder' => 'insert your post image here      (max: 1 )',  'multiple'=>'false']) !!}
            @endforeach
        @else
            {!! Form::file('image', ['id' => 'fileupload','class' => 'file-input',  'placeholder' => 'insert your post image here      (max: 1 )',  'multiple'=>'false']) !!}
        @endif

    </div>


    <div class="clearfix"></div>

    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}

    <div class="row">
        <div class="form-group p">
            @if(isset($quiz))

                @if($quiz->picture())
                    <div class="s-12 m-10 l-10 l-offset-1 m-offset-1">
                        <div class="thumbnail" style='background: #ffffff'>
                            @foreach($picture as $pic)
                                <img  class="img-responsive" style="" src="{!! asset('images/quizzes/' . $pic->path) !!}">
                            @endforeach

                        </div>
                    </div>

                @endif

            @endif

        </div>

    </div>
    <div class="form-group">
        {!! Form::submit($submitButton, ['class' => 'confirm button button-primary'])!!}
    </div>



</div>
@section('styles-add')
@endsection
@section('scripts-add')
    <script src="{{ asset('dist/vendor/pickadate/lib/picker.js') }}"></script>
    <script src="{{ asset('dist/vendor/pickadate/lib/picker.date.js') }}"></script>
    <script src="{{ asset('dist/vendor/pickadate/lib/picker.time.js') }}"></script>
    <script>
        //        $(function() {
        //            $('#fileupload').imgPreview();
        //        });
        $('#name').simplyCountable({
            counter:            '#counter1',
            countType:          'characters',
            maxCount:           120,
            strictMax:          true,
            countDirection:     'down',
            safeClass:          'safe',
            overClass:          'over',
            thousandSeparator:  ',',
            onOverCount:        function(count, countable, counter){},
            onSafeCount:        function(count, countable, counter){},
            onMaxCount:         function(count, countable, counter){}
        });
        $('#question').simplyCountable({
            counter:            '#counter2',
            countType:          'characters',
            maxCount:           300,
            strictMax:          true,
            countDirection:     'down',
            safeClass:          'safe',
            overClass:          'over',
            thousandSeparator:  ',',
            onOverCount:        function(count, countable, counter){},
            onSafeCount:        function(count, countable, counter){},
            onMaxCount:         function(count, countable, counter){}
        });
        var tag_options = {
            "no-duplicate": true,
            "no-duplicate-callback": window.alert,
            "no-duplicate-text": "Duplicate tags",
            "type-zone-class": "type-zone",
            "tag-box-class": "tagging",
            "edit-on-delete": false,
            "forbidden-chars": [",", ".", "_", "?"]
        };
        var tagBox = $("#tagBox");
        tagBox.tagging(tag_options);
        $('.type-zone').attr('placeholder' ,'at least one tag');
        @if(url(App::getLocale().'/quiz/create') !== Request::url())
        @include('Quiz.updateFormScript')
        @endif
            $('.datepicker').pickadate();


    </script>

@endsection