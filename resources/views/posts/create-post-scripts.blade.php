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
    <script type="text/javascript">
        $(function() {
            var editor = editormd("editormd", {
                width  : "100%",
                height : 500,
                emoji: false,
                paceholder: "### Hello Editor.md !",
                theme        : (localStorage.theme) ? localStorage.theme : "default",
                toolbarIcons : function() {
                    // Or return editormd.toolbarModes[name]; // full, simple, mini
                    // Using "||" set icons align right.
                    return ["undo", "redo", "|", "bold", "hr", "|", "code-block", "code", "watch", "datetime", "link", "list-ol", "list-ul","del","italic", "quote", "||",  "fullscreen", "preview", "search"]
                },
                htmlDecode : true,
                tex : true,
                taskList : true,
                flowChart : true,
                sequenceDiagram : true,
                path : "http://www.itway.io/dist/vendor/editor.md/lib/" // Autoload modules mode, codemirror, marked... dependents libs path
            });
            console.log(editormd.toolbarModes[name]);
            editor.setCodeMirrorTheme('neo');
        });
    </script>
    <script>
        var title = $('#title'),
            preamble = $('#preamble');
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
        preamble.simplyCountable({
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
        $('#poll-name').simplyCountable({
            counter:            '#poll-name-counter',
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
        $('#poll-hint').simplyCountable({
            counter:            '#poll-hint-counter',
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
            "forbidden-chars": [",", "_", "?"]
        };
        var tagBox = $("#tagBox");
        tagBox.tagging(tag_options);
        $('.type-zone').attr('placeholder' ,'at least one tag');
        @if(url(App::getLocale().'/blog/create') !== Request::url())
        @include('posts.updateFormScript')
        @endif
        var datepicker = $( "#datepicker" );
        datepicker.dateDropper({ format:"Y-m-d", option:datepicker.val(), animation:"dropDown", animate_current:"false"});
        title.focus()
    </script>
@endsection
