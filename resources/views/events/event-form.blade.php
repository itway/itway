<div class="l-12 m-12 s-12 xs-12 create-form">
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
        <div id="editormd">
        <textarea name="description" cols="120" rows="60" class="event-body input input-line hidden" id="editor" hidden
                  style="height:300px"
                  placeholder="Please write your event description!">@if(isset($event))<?php $body = $event->getDescription();echo $body['description'];?>@endif</textarea>
        </div>
        <div class="clearfix"></div>
        {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="two fields">
        <div class="field">
            <span class="label titl">#{{trans('event-form.event-format')}}</span>
            {!!Form::select('event_format', config('event-formats'), null,
            ["id"=>"event_format",
            "class"=>"ui event-format-list fluid search normal selection dropdown"])!!}
            <div class="clearfix"></div>
            {!! $errors->first('event_format', '<div class="text-danger">:message</div>') !!}
        </div>
        <div class="field">
            <span class="label titl">#{{trans('event-form.event-timezone')}}</span>
            {!!$timezoneBuilder!!}
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            <span class="label titl">{{trans('event-form.time')}}</span>
            <input type="time"
                   value="{{\Carbon\Carbon::createFromTime(12, 0, 0, 'Europe/London')->toTimeString()}}"
                   placeholder="time of event" class="input-line time" title="time of event" name="time">
        </div>
        <div class="field">
            <span class="label titl">{{trans('event-form.date')}}</span>
            <input type="date"
                   placeholder="date of event"
                   class="input-line date"
                   title="date of event dd-mm-yyyy"
                   name="date">
        </div>
    </div>
    <div class="field">
        <div class="btns-block">
            <span class="label titl text-center">{{trans('event-form.attach')}}</span>

            <div class="clearfix"></div>
            @include('events.attach-block', [$model = isset($event) ? $event : null])
            @include('events.image-modal', [$model = isset($event) ? $event : null])
            @include('events.video-modal', [$model = isset($event) ? $event : null])
            @include('events.poll-modal', [$model = isset($event) ? $event : null])
            <div class="clearfix"></div>
            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
            <div class="clearfix"></div>
            {!! $errors->first('youtube_link', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="text-center">
        {!! Form::submit('Create event', ['class' => 'button button-primary'])!!}
    </div>
</div>
@include('events.create-event-scripts')

