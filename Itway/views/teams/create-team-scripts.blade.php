@section('styles-add')
    <link rel="stylesheet" href="{{asset('dist/vendor/editor.md/css/editormd.min.css')}}">
@endsection
@section('scripts-add')
    <script src="{{asset('dist/vendor/editor.md/editormd.min.js')}}"></script>
    @if(App::getLocale() == "en")
        <script src="{{asset('dist/vendor/editor.md/languages/en.js')}}"></script>
    @elseif(App::getLocale() == "ru")
        <script src="{{asset('dist/vendor/editor.md/languages/ru.js')}}"></script>
    @endif
    <script>
        var title = $('#title');
        title.simplyCountable({
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
        title.focus();
        $('.ui.dropdown.search')
                            .dropdown({
                                minCharacters : 3,
                                allowAdditions:false,
                                maxSelections: 3

                });
        $('#select-trend.ui.dropdown').dropdown({
            maxSelections: 2,
            allowAdditions:false
        });
        $('.ui.normal.skills.dropdown')
                .dropdown({
                    minCharacters : 2,
                    allowAdditions: true,
                    multiple: true,
                    maxSelections: 8
                })
        ;
    </script>
@endsection