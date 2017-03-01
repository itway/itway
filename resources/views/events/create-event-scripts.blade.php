@section('styles-add')
    <link rel="stylesheet" href="{{asset('dist/vendor/editor.md/css/editormd.min.css')}}">
    <style>
        [href="#top"] {
            color: #999;
            float: right;
            padding-top: 10px;
            display: block;
            text-decoration: none;
            font-size: 12px;
            font-weight: normal;
        }

        [href="#top"] .fa {
            margin-left: 8px;
            font-size: 1.4em;
        }
    </style>
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
                paceholder: "### Hello Editor.md !",
                theme        : (localStorage.theme) ? localStorage.theme : "default",
                tex              : true,
                tocm             : true,
                emoji            : true,
                taskList         : true,
                codeFold         : true,
                searchReplace    : true,
                htmlDecode : "style,script,iframe",
                flowChart        : true,
                sequenceDiagram  : true,
                syncScrolling : "single",
                editorTheme : editormd.editorThemes['neo'],
                toolbarAutoFixed: false,
                onfullscreen : function() {
                    this.editor.css("border-radius", 0).css("z-index", 120);
                },
                onfullscreenExit : function() {
                    this.editor.css({
                        zIndex : 10,
                        border : "none",
                        "border-radius" : "5px"
                    });
                    this.resize();
                },
                toolbarIcons : function() {
                    // Or return editormd.toolbarModes[name]; // full, simple, mini
                    // Using "||" set icons align right.
                    return ["undo", "redo", "|", "bold", "hr", "|", "code-block", "code", "watch", "datetime", "link", "list-ol", "list-ul","del","italic", "quote", "||",  "fullscreen", "preview", "search"]
                },
                path : APP_URL+"/dist/vendor/editor.md/lib/" // Autoload modules mode, codemirror, marked... dependents libs path
            });
        });
    </script>
    <script>
        var title = $('#title'),
                preamble = $('#preamble');
        title.simplyCountable({
            counter: '#counter1',
            countType: 'characters',
            maxCount: 120,
            strictMax: true,
            countDirection: 'down',
            safeClass: 'safe',
            overClass: 'over',
            thousandSeparator: ',',
            onOverCount: function (count, countable, counter) {
            },
            onSafeCount: function (count, countable, counter) {
            },
            onMaxCount: function (count, countable, counter) {
            }
        });
        preamble.simplyCountable({
            counter: '#counter2',
            countType: 'characters',
            maxCount: 300,
            strictMax: true,
            countDirection: 'down',
            safeClass: 'safe',
            overClass: 'over',
            thousandSeparator: ',',
            onOverCount: function (count, countable, counter) {
            },
            onSafeCount: function (count, countable, counter) {
            },
            onMaxCount: function (count, countable, counter) {
            }
        });
        title.focus();
        $('.ui.dropdown.search')
                .dropdown({
                    minCharacters: 3,
                    allowAdditions: false,
                    maxSelections: 3
                });
        $('#select-trend.ui.dropdown').dropdown({
            maxSelections: 2,
            allowAdditions: false
        });
        $('.ui.normal.tag-list.dropdown')
                .dropdown({
                    minCharacters: 2,
                    allowAdditions: true,
                    multiple: true,
                    maxSelections: 8
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
        var datepicker = $(".date");
        datepicker.pickadate({format: "yyyy-mm-dd"});
        $('.speakersdrop')
                .dropdown({
                    minCharacters: 2,
                    allowAdditions: false,
                    maxSelections: 5,
                    apiSettings: {
                        url: 'http://www.itway.io/user/{query}'
                    }
                })
        ;
    </script>
@endsection