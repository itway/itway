<div class="ui dropdown item lang-choose">
    <i class="icon-location_history"></i> {{trans('navigation.LangInfo')}}
    <i class="dropdown icon"></i>

    <div class="menu">
        {!! Form::open(["class"=>"language-chooser item", "url"=> URL::route('language-chooser'), "method"=>"post"])!!}
        <select name="locale" class="button button-primary hidden" id="locale">
            <option class="button button-primary hidden" value="ru">Russian</option>
            <option class="button button-primary hidden" value="en" {{ Lang::locale() === 'en' ? '' : 'selected'}}>
                English
            </option>
        </select>
        <button class="" style="border:none; outline: none; background: transparent;">
            {{ Lang::locale() === 'en' ? 'ru' : 'en'}} version
        </button>
        <?php
        $uri = $_SERVER['REQUEST_URI'];
        $uri = ltrim($uri, '/');
        ?>
        <input type="text" hidden name="url" value="{{$uri}}">
        {{--{!! Form::token() !!}--}}
        {!! Form::close() !!}
    </div>
</div>