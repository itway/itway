<div class="l-12 m-12 s-12 xs-12 side-form-tabs">
    <div class="menu">
        <div class="ui secondary horizontal pointing menu tabs-line">
            <a class="item  active" data-tab="main">
                {{trans('event-form.tabs.main')}}
            </a>
            <a class="item" data-tab="optional">
                {{trans('event-form.tabs.optional')}}
            </a>
            <a class="item" data-tab="logo" >
                {{trans('event-form.tabs.logo')}}
            </a>
            <a class="item" data-tab="speakers">
                {{trans('event-form.tabs.speakers')}}
            </a>
        </div>
    </div>
    <div class="l-12 m-12 s-12 xs-12 create-form">
        @include('events.main-tab-body')
        @include('events.optional-tab-body')
        @include('events.logo-tab-body')
        @include('events.speakers-tab-body')
        <div class="clearfix"></div>
        <div class="text-center">
            {!! Form::submit('Create event', ['class' => 'button button-primary'])!!}
        </div>
    </div>
</div>
@include('events.create-event-scripts')

