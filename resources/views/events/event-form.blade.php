<div class="l-12 m-12 s-12 xs-12 side-form-tabs">
    <div class="menu">
        <div class="ui secondary horizontal pointing menu tabs-line">
            <a class="item  active" data-tab="main">
                Main
            </a>
            <a class="item" data-tab="description">
                Event description
            </a>
            <a class="item" data-tab="logo" >
                Event logo
            </a>
            <a class="item" data-tab="speakers">
                Event speakers
            </a>
        </div>
    </div>
    <div class="l-12 m-12 s-12 xs-12 create-form">
        <div class="ui top attached tab active" data-tab="main">
            <div class="field">
                <div class="title-block ">
                    <span class="label titl">{{trans('event-form.name')}}</span>

                    <div class="clearfix"></div>
                    {!! Form::text('name', null, ['class' => 'input-line', 'id' => 'title','placeholder' => 'insert event\'s name here      (max:120)'])!!}
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
            <div class="field">
                <span class="label titl">#{{trans('event-form.event-format')}}</span>
                {!!Form::select('event_format', config('event-formats'), null, ["id"=>"event_format", "class"=>"ui event-format-list fluid multiple search normal selection dropdown"])!!}
            </div>
            <div class="field">
                <span class="label titl">#{{trans('event-form.event-timezone')}}</span>
                {!!$timezoneBuilder!!}
            </div>
            <span class="label titl">{{trans('event-form.location')}}</span>
            <div class="clearfix"></div>
            <div class="two  fields">
                <div class="field">
                    {!! $countryBuilder !!}
                </div>
                <div class="field">
                    <input type="text" name="city" value="" class="input-line" placeholder="event city">
                </div>
            </div>
            <span class="label titl">{{trans('event-form.organizer')}}</span>
            <div class="clearfix"></div>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="organizer" placeholder="organizer" class="input-line organizer">
                </div>
                <div class="field">
                    <input type="text" name="organizer_link" placeholder="organizer_link"
                           class="input-line organizer_link">
                </div>
            </div>
            <div class="three fields">
                <div class="field">
                    <span class="label titl">{{trans('event-form.time')}}</span>
                    <input type="time" value="{{\Carbon\Carbon::createFromTime(12, 0, 0, 'Europe/London')->toTimeString()}}"
                           placeholder="time of event" class="input-line time">
                </div>
                <div class="field">
                    <span class="label titl">{{trans('event-form.date')}}</span>
                    <input type="date" placeholder="date of event" class="input-line date">
                </div>
                <div class="field">
                    <span class="label titl">{{trans('event-form.people-number')}}</span>
                    <input type="number" name="max_people_number" placeholder="max people number" class="input-line">
                </div>
            </div>
        </div>
        <div class="ui top attached tab " data-tab="description">
            <div class="clearfix"></div>
            <span class="label titl">{{trans('event-form.description')}}</span>
        </div>
        <div class="ui top attached tab " data-tab="logo">
            <span class="label titl">{{trans('event-form.logo')}}</span>
            <div class="description">
                <label for="photoUpload" class="filelabel filelabel-event custom-file-input">
                    @if(isset($event) && $event->picture())
                        <div class="photo-block">
                            <div class="thumbnail" style='background: #ffffff'>
                                @foreach($picture as $pic)
                                    <img class="img-responsive" style=""
                                         src="{!! asset('images/events/' . $pic->path) !!}">
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="photo-block"></div>
                    @endif
                    <span class="upload-span"><i class="fa fa-camera fa-2x"></i><br>Upload<br>event logo</span>
                </label>
                {!! Form::file('logo', ['id' => 'photoUpload','class' => 'file-input', 'data-multiple-caption'=> null, 'placeholder' => 'insert your post image here      (max: 1 )']) !!}
            </div>
            <br></div>
        <div class="ui top attached tab " data-tab="speakers">
            Event speakers
        </div>
        <div class="clearfix"></div>
        <div class="text-center">
            {!! Form::submit('Create event', ['class' => 'button button-primary'])!!}
        </div>
    </div>
</div>
@include('events.create-event-scripts')

