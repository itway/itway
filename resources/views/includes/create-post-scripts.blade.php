@section('styles-add')
    <link rel="stylesheet" href="{{ asset('vendor/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
@endsection
@section('scripts-add')

    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>

</script>
    {{--<script src="{{asset('vendor/ckeditor/config.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('vendor/ckeditor/adapters/jquery.js')}}"></script>

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

    @include('includes.ckeitor-config')
@endsection
