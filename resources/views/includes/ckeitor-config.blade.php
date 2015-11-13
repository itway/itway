<script>


    /* exported initSample */

    if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
        CKEDITOR.tools.enableHtml5Elements( document );


    // The trick to keep the editor in the sample quite small
    // unless user specified own height.
    CKEDITOR.config.language = '{{App::getLocale()}}';
    CKEDITOR.config.height = 300;
    CKEDITOR.config.width = '100%';
    CKEDITOR.config.extraPlugins = 'codesnippet';
    CKEDITOR.config.extraPlugins = 'autosave';
    CKEDITOR.config.codeSnippet_theme = 'mono-blue';
    CKEDITOR.config.placeholder = 'Please write your post!';
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.uiColor = 'transparent';
    CKEDITOR.config.autosave_NotOlderThen = 10080;
    CKEDITOR.config.autosave_delay = 10;


    var initSample = ( function() {
        var wysiwygareaAvailable = isWysiwygareaAvailable(),
                isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

        return function() {
            var editorElement = CKEDITOR.document.getById( 'editor' );

            // :(((
            if ( isBBCodeBuiltIn ) {
                editorElement.setHtml(
                        'Hello write something amazing!\n\n'
                );
            }

            // Depending on the wysiwygare plugin availability initialize classic or inline editor.
            if ( wysiwygareaAvailable ) {
                window.onload = function() {
                    CKEDITOR.replace( 'editor' );
                };
            } else {
                editorElement.setAttribute( 'contenteditable', 'true' );
                CKEDITOR.inline( 'editor' );

                // TODO we can consider displaying some info box that
                // without wysiwygarea the classic editor may not work.
            }
        };

        function isWysiwygareaAvailable() {
            // If in development mode, then the wysiwygarea must be available.
            // Split REV into two strings so builder does not replace it :D.
            if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
                return true;
            }

            return !!CKEDITOR.plugins.get( 'wysiwygarea' );
        }
    } )();


</script>