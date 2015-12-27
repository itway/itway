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
        $('.ui.normal.tag-list.dropdown')
                .dropdown({
                    minCharacters : 2,
                    allowAdditions: true,
                    multiple: true,
                    maxSelections: 8
                });

        var addEditor = function() {
            $.getScript("http://www.itway.io/dist/vendor/editor.md/editormd.min.js", function () {
                $(".attached.tab[data-tab='description']").append("<div id=\"editormd\"></div>");

                var editor = editormd("editormd", {
                    width: "100%",
                    height: 500,
                    paceholder: "### Hello Editor.md !",
                    theme: (localStorage.theme) ? localStorage.theme : "default",
                    tex: true,
                    tocm: true,
                    emoji: true,
                    taskList: true,
                    codeFold: true,
                    searchReplace: true,
                    htmlDecode: "style,script,iframe",
                    flowChart: true,
                    sequenceDiagram: true,
                    syncScrolling: "single",
                    editorTheme: editormd.editorThemes['neo'],
                    toolbarAutoFixed: false,
                    onfullscreen: function () {
                        this.editor.css("border-radius", 0).css("z-index", 120);
                    },
                    onfullscreenExit: function () {
                        this.editor.css({
                            zIndex: 10,
                            border: "none",
                            "border-radius": "5px"
                        });
                        this.resize();
                    },
                    toolbarIcons: function () {
                        // Or return editormd.toolbarModes[name]; // full, simple, mini
                        // Using "||" set icons align right.
                        return ["undo", "redo", "|", "bold", "hr", "|", "code-block", "code", "watch", "datetime", "link", "list-ol", "list-ul", "del", "italic", "quote", "||", "fullscreen", "preview", "search"]
                    },
                    path: "http://www.itway.io/dist/vendor/editor.md/lib/" // Autoload modules mode, codemirror, marked... dependents libs path
                });
            });
        };

        $('.side-form-tabs .menu .item')
                .tab({
                    context : '.side-form-tabs',
                    history : true,
                    evaluateScripts: true,
                    onLoad: function(path, parameterArray, historyEvent) {
                        if(path == "description" && $('#editormd').length === 0){
                            addEditor();
                        }
                    }
                })
        ;

        $('.side-form-tabs .item[data-tab="main"]')
                .popup({
                    variation: 'inverted',
                    position: 'bottom left',
                    on: 'click',
                    html: "Main <a href=\"#/main/#info-main\" >info</a>"
                })
        ;
        $('.side-form-tabs .item[data-tab="description"]')
                .popup({
                    variation: 'inverted',
                    position: 'bottom left',
                    on: 'click',
                    html: "Event description <a href=\"#/description/#info-description\" >info</a>"
                })
        ;
        $('.side-form-tabs .item[data-tab="logo"]')
                .popup({
                    variation: 'inverted',
                    position: 'bottom left',
                    on: 'click',
                    html: "Event logo <a href=\"#/logo/#info-logo\" >info</a>"
                })
        ;
        $('.side-form-tabs .item[data-tab="speakers"]')
                .popup({
                    variation: 'inverted',
                    position: 'bottom left',
                    on: 'click',
                    html: "Event speakers <a href=\"#/speakers/#info-speakers\" >info</a>"
                })
        ;
        var datepicker = $(".date");
        datepicker.pickadate({format:"yyyy-mm-dd"});
    </script>
    <script type="text/javascript">

    </script>
@endsection