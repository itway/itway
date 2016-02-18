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
        <div class="l-12 m-12 s-12">
            <h3 class="title-underlined text-info">{{trans('profile.user_settings')}}</h3>
        </div>
        <div class="l-12 m-12 s-12">
            <div class="ui special fluid cards">
                <div class="card fluid">
                    <div class="content">
                        {!! Form::model($user,  ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeFullname', 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}
                        <div class="form-group">
                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                <h5 class="text-info ">{{trans('profile.alter_user_fullname')}}</h5>
                                {!! Form::text('name',  $user->name  ,array( 'class' => 'input input-line', 'id' => 'fullname', 'placeholder' => trans("placeholders.profile.fullname"))) !!}
                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!! Form::model($user,  ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeEmail' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}
                        <div class="form-group">

                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                <h5 class="text-info ">{{trans('profile.alter_user_email')}} </h5>

                                {!! Form::email('email', null, array( 'class' => 'input input-line', 'id' => 'email', 'placeholder' =>  trans("placeholders.profile.email"))) !!}

                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changePassword' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                        <div class="form-group">
                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                <h5 class="text-info ">{{trans('profile.alter_user_password')}}</h5>

                                {!! Form::password('password' ,array( 'class' => 'input input-line', 'id' => 'password', 'placeholder' =>  trans("placeholders.profile.password"))) !!}
                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changelocation' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}
                        <div class="form-group">
                        <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                            <h5 class="text-info ">{{trans('profile.alter_user_country')}}</h5>
                            <div class="field">
                                {!! $countryBuilder !!}
                            </div>
                            <div class="pull-right">
                                {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('country', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeGoogle' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                        <div class="form-group">
                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                <h5 class="text-info ">{{trans('profile.alter_user_google')}}</h5>

                                {!! Form::text('Google', null, array( 'class' => 'input input-line', 'id' => 'linkToGoogle', 'placeholder' =>  trans("placeholders.profile.google"))) !!}
                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('Google', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!!  Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeTwitter' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                        <div class="form-group">

                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                <h5 class="text-info ">{{trans('profile.alter_user_twitter')}}</h5>

                                {!! Form::text('Twitter',  null, array( 'class' => 'input input-line', 'id' => 'linkToTwitter', 'placeholder' =>  trans("placeholders.profile.twitter"))) !!}
                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' ))!!}
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            {!! $errors->first('Twitter', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id],'id' => 'changeFacebook' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                        <div class="form-group">
                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                                <h5 class="text-info ">{{trans('profile.alter_user_facebook')}} </h5>

                                {!! Form::text('Facebook',  null, array( 'class' => 'input input-line', 'id' => 'linkToFacebook', 'placeholder' =>  trans("placeholders.profile.Facebook"))) !!}
                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}</div>
                            </div>

                        </div>
                        <div class="text-center">
                            {!! $errors->first('Facebook', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">

                        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeGithub' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                        <div class="form-group">
                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                                <h5 class="text-info ">{{trans('profile.alter_user_github')}} </h5>

                                {!! Form::text('Github', null, array( 'class' => 'input input-line', 'id' => 'linkToGithub', 'placeholder' => trans("placeholders.profile.Github"))) !!}
                                <div class="pull-right">
                                    {!! Form::submit(trans('forms.change'), array( 'class' => 'button button-default' )) !!}

                                </div>

                            </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('Github', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="card fluid">
                    <div class="content">
                        {!!Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'tags' , 'class' => 'form', 'role' =>  'form'])!!}

                        <div class="form-group">
                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                                <h5 class="text-info ">{{trans('profile.alter_user_skills')}} </h5>

                                <div data-tags-input-name="tags_list" id="tagBox"></div>
                                <div class="pull-right">

                                    {!! Form::submit(trans('forms.add'), array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                        {!! $errors->first('tags_list', '<div class="text-danger">:message</div>') !!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
            <div class="ui special fluid cards">

                <div class="card fluid">
                    <div class="content">
                        {!!Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'about-user' , 'class' => 'form', 'role' =>  'form'])!!}

                        <div class="form-group">

                            <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                                <h5 class="text-info ">{{trans('profile.alter_user_bio_top')}}</h5>

                                <div class="pos-rel">
                                    <div class="input-count">left <span id="counter1"></span> symbols.</div>
                                </div>
                                {!!Form::textarea('bio',  null, ['class'=>'input input-line', 'rows'=> '10',  'id'=>'about-yourself'])!!}

                                <span class="help-block">{{trans("placeholders.profile.bio")}}</span>

                                <div class="pull-right">

                                    {!! Form::submit(trans('forms.add'), array( 'class' => 'button button-default' )) !!}
                                </div>

                            </div>
                        </div>
                        <div class="text-center">
                            {!! $errors->first('bio', '<div class="text-danger">:message</div>') !!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
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

    </script>
@overwrite
@endif
