<div class="ui top attached tab active" data-tab="main">
    <div class="two fields">
        <div class="field">
            <div class="title-block">
                <span class="label titl">{{trans('event-form.name')}}</span>

                <div class="clearfix"></div>
                {!! Form::text('name', null,
                ['class' => 'input-line',
                'id' => 'title',
                'placeholder' => 'insert event\'s name here      (max:120)'])!!}
                <div class="pos-rel">
                    <div class="input-count">left <span id="counter1"></span> symbols.</div>
                </div>
                <div class="clearfix"></div>
                {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>

        <div class="field">
            <div class="tag-block">
                <span class="label titl">#{{trans('event-form.tags')}}</span>

                <div class="clearfix"></div>
                {!! $tagsBuilder !!}
                <div class="clearfix"></div>
                {!! $errors->first('tags_list', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            <span class="label titl">#{{trans('event-form.event-format')}}</span>
            {!!Form::select('event_format', config('event-formats'), null,
            ["id"=>"event_format",
            "class"=>"ui event-format-list fluid search normal selection dropdown"])!!}
        </div>
        <div class="field">
            <span class="label titl">#{{trans('event-form.event-timezone')}}</span>
            {!!$timezoneBuilder!!}
        </div>
    </div>
    <div class="field">
        <div class="preamble-block">
            <span class="label titl">{{trans('event-form.preamble')}}</span>

            <div class="clearfix"></div>
            {!! Form::textarea('preamble', null, ['class' => 'input-line', 'id' => 'preamble','rows' => '3', 'placeholder' => 'insert your preamble here      (max:300)'])!!}
            <div class="pos-rel">
                <div class="input-count">left <span id="counter2"></span> symbols.</div>
            </div>
            <div class="clearfix"></div>
            {!! $errors->first('preamble', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>
    <div class="event-desc-block">
        <div class="clearfix"></div>
        <span class="label titl">{{trans('event-form.description')}}</span>
    </div>
    <div class="two fields">
        <div class="field">
            <span class="label titl">{{trans('event-form.time')}}</span>
            <input type="time"
                   value="{{\Carbon\Carbon::createFromTime(12, 0, 0, 'Europe/London')->toTimeString()}}"
                   placeholder="time of event" class="input-line time">
        </div>
        <div class="field">
            <span class="label titl">{{trans('event-form.date')}}</span>
            <input type="date"
                   placeholder="date of event"
                   class="input-line date">
        </div>
    </div>
</div>