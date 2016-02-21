@extends('app')
@section('sitelocation')
    <?php  $name = 'U'; ?>
    <?php  $msg = "User";  ?>
@endsection
@section('navigation.buttons')
    @include('user.site-btns')
@endsection
@section('content')
    @if (!Auth::check())
        {{Redirect::to(URL::previous())}}
    @else
            {!! Form::model($user,  ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeFullname', 'class' => 'form card-material-lightgrey', 'role' =>  'form', 'autocomplete' => 'off']) !!}

            <div class="ui l-12 m-12 s-12">
                <h3 class="title-underlined text-info">{{trans('profile.user_settings')}}</h3>
            </div>
            <div class="l-12 m-12 s-12 ui fluid" id="profile">
                <div class="ui sticky bottom" style="padding-right: 14px; padding-left: 10px;">
                    <div class="ui fluid one item tabular menu @if (count($errors) > 0) {!! "error_line" !!} @endif" >
                        {!! Form::submit(trans('forms.change'), array( 'class' => 'item button button-primary settings_change_btn' )) !!}
                    </div>
                </div>
                <div class="ui special fluid cards">
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_fullname')}}</h5>
                                        {!! Form::text('name',  $user->name  ,array( 'class' => 'input input-line', 'id' => 'fullname', 'placeholder' => trans("placeholders.profile.fullname"))) !!}
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>

                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_email')}} </h5>
                                        {!! Form::email('email', null, array( 'class' => 'input input-line', 'id' => 'email', 'placeholder' =>  trans("placeholders.profile.email"))) !!}
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_password')}}</h5>
                                        {!! Form::password('password' ,array( 'class' => 'input input-line', 'autocomplete' =>'off', 'id' => 'password', 'placeholder' =>  trans("placeholders.profile.password"))) !!}
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_country')}}</h5>

                                        <div class="field">
                                            {!! $countryBuilder !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $errors->first('country', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_google')}}</h5>
                                        {!! Form::text('Google', null, array( 'class' => 'input input-line', 'id' => 'linkToGoogle', 'placeholder' =>  trans("placeholders.profile.google"))) !!}
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $errors->first('Google', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">

                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_twitter')}}</h5>

                                        {!! Form::text('Twitter',  null, array( 'class' => 'input input-line', 'id' => 'linkToTwitter', 'placeholder' =>  trans("placeholders.profile.twitter"))) !!}
                                    </div>
                                </div>

                                <div class="text-center">
                                    {!! $errors->first('Twitter', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                        <h5 class="text-info ">{{trans('profile.alter_user_facebook')}} </h5>

                                        {!! Form::text('Facebook',  null, array( 'class' => 'input input-line', 'id' => 'linkToFacebook', 'placeholder' =>  trans("placeholders.profile.Facebook"))) !!}
                                    </div>

                                </div>
                                <div class="text-center">
                                    {!! $errors->first('Facebook', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                                        <h5 class="text-info ">{{trans('profile.alter_user_github')}} </h5>
                                        {!! Form::text('Github', null, array( 'class' => 'input input-line', 'id' => 'linkToGithub', 'placeholder' => trans("placeholders.profile.Github"))) !!}
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $errors->first('Github', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card fluid">
                        <div class="content">
                            <div class="form card-material-lightgrey">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                                        <h5 class="text-info ">{{trans('profile.alter_user_skills')}} </h5>

                                        <div data-tags-input-name="tags_list" id="tagBox"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-center">
                                {!! $errors->first('tags_list', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui special fluid cards">

                    <div class="card fluid">
                        <div class="content">
                            <div class="form" id="about-user">
                                <div class="form-group">
                                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                                        <h5 class="text-info ">{{trans('profile.alter_user_bio_top')}}</h5>

                                        <div class="pos-rel">
                                            <div class="input-count">left <span id="counter1"></span> symbols.</div>
                                        </div>
                                        {!!Form::textarea('bio',  null, ['class'=>'input input-line', 'rows'=> '10',  'id'=>'about-yourself'])!!}

                                        <span class="help-block">{{trans("placeholders.profile.bio")}}</span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $errors->first('bio', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    {!! Form::close() !!}
@overwrite
@section('styles-add')
    {{--<link rel="stylesheet" href="{{asset('dist\components\tab.css')}}"/>--}}
@endsection
@section('scripts-add')
    {{--<script src="{{asset('dist/components/tab.min.js')}}"></script>--}}
    <script>
        $('#about-yourself').simplyCountable({
            counter: '#counter1',
            countType: 'characters',
            maxCount: 1000,
            strictMax: true,
            countDirection: 'down',
            safeClass: 'safe',
            overClass: 'over',
            thousandSeparator: ',',
            onOverCount: function (count, countable, counter) {
            },
            onSafeCount: function (count, countable, counter) {
            },
            onMaxCount: function (count, countable, counter) {
            }
        });
        var tag_options = {
            "no-duplicate": true,
            "no-duplicate-callback": window.alert,
            "no-duplicate-text": "Duplicate tags",
            "type-zone-class": "type-zone",
            "tag-box-class": "tagging",
            "edit-on-delete": false,
            "forbidden-chars": [",", ".", "_", "?"]
        };
        var tagBox = $("#tagBox");
        tagBox.tagging(tag_options);
        $('.type-zone').attr('placeholder', "{{trans("placeholders.profile.tag_list")}}");
        @if(Route::currentRouteName() === 'itway::user::settings')
            @include('user.updateFormScript')
        @endif
         $('.ui.dropdown.search')
                .dropdown({
                    minCharacters: 3,
                    allowAdditions: false,
                    maxSelections: 3
                });
        var fullname = $('#fullname').focus();
        $('.ui.sticky')
                .sticky({
                    bottomOffset : 0,
                    context: '#profile',
                    offset       : 0
                });
//        $('.settings_change_btn').width($("#profile").innerWidth() - 50)

    </script>
@overwrite
@endif
