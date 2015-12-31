<div class="ui top attached tab " data-tab="optional">
    <span class="label titl">{{trans('event-form.location')}}</span>
    <div class="clearfix"></div>
    <div class="three  fields">
        <div class="field">
            {!! $countryBuilder !!}
        </div>
        <div class="field">
            <input type="text"
                   name="city"
                   value=""
                   class="input-line"
                   placeholder="event city">
        </div>
        <div class="field">
            <input type="text"
                   name="address"
                   value=""
                   class="input-line"
                   placeholder="event address">
        </div>
    </div>
    <div class="two-fields">
        <div class="field">
            <span class="label titl">#{{trans('event-form.event-format')}}</span>
            {!!Form::select('event_format', config('event-formats'), null,
            ["id"=>"event_format",
            "class"=>"ui event-format-list fluid multiple search normal selection dropdown"])!!}
        </div>
        <div class="field">
            <span class="label titl">{{trans('event-form.invite')}}</span>
            <input type="text"
                   name="event_invite"
                   placeholder="invite link"
                   class="input-line">
        </div>
    </div>

    <div class="field">
        <span class="label titl">#{{trans('event-form.event-timezone')}}</span>
        {!!$timezoneBuilder!!}
    </div>

    <span class="label titl">{{trans('event-form.organizer')}}</span>

    <div class="clearfix"></div>
    <div class="two fields">
        <div class="field">
            <input type="text"
                   name="organizer"
                   placeholder="organizer"
                   class="input-line organizer">
        </div>
        <div class="field">
            <input type="text"
                   name="organizer_link"
                   placeholder="organizer_link"
                   class="input-line organizer_link">
        </div>
    </div>
    <div class="field">
        <span class="label titl">{{trans('event-form.people-number')}}</span>
        <input type="number"
               name="max_people_number"
               placeholder="max people number"
               class="input-line">
    </div>
</div>
