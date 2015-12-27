<?php $i = 0; ?>
<select {!! isset($multiple) ? "multiple" : null !!} style="z-index: 25!important;" name="{!! isset($attrName) ? $attrName : "tags_list[]"!!}"
        class="ui {!! isset($class) ? $class : "tags"!!} fluid {!! isset($multiple) ? "multiple" : null !!} search normal selection dropdown" title="{!! trans('forms.tag-default') !!}">
    @foreach($result as $item => $tag)
        <?php $i++;?>
        @if($i <= 1)
            <option value="">{!! isset($placeholder) ? $placeholder : trans('forms.tag-default') !!}</option>
        @else
            <option {!! array_key_exists(ucfirst($item), array_flip($selected)) == true ?  "selected" : null !!}  value="{!! strtolower($item) !!}">{{ucfirst($tag)}}</option>
        @endif
    @endforeach
</select>
