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
                                {!! Form::text('name',  $user->name  ,array( 'class' => 'input input-line', 'id' => 'fullname', 'placeholder' => 'пожалуйста введите имя и фамилию')) !!}
                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>
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


                                {!! Form::email('email', null, array( 'class' => 'input input-line', 'id' => 'email', 'placeholder' => 'введите ваш email')) !!}

                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>

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

                                {!! Form::password('password' ,array( 'class' => 'input input-line', 'id' => 'password', 'placeholder' => 'введите ваш пароль')) !!}
                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>
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
                                {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                            </div>
                        </div>
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

                                {!! Form::text('Google', null, array( 'class' => 'input input-line', 'id' => 'linkToGoogle', 'placeholder' => 'введите ваш google аккаунт')) !!}
                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>
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

                                {!! Form::text('Twitter',  null, array( 'class' => 'input input-line', 'id' => 'linkToTwitter', 'placeholder' => 'введите ваш twitter аккаунт')) !!}
                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' ))!!}
                                </div>
                            </div>
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

                                {!! Form::text('Facebook',  null, array( 'class' => 'input input-line', 'id' => 'linkToFacebook', 'placeholder' => 'введите ваш facebook аккаунт')) !!}
                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}</div>
                            </div>

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

                                {!! Form::text('Github', null, array( 'class' => 'input input-line', 'id' => 'linkToGithub', 'placeholder' => 'введите ваш github аккаунт')) !!}
                                <div class="pull-right">
                                    {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}

                                </div>

                            </div>
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

                                    {!! Form::submit('Добавить', array( 'class' => 'button button-default' )) !!}
                                </div>
                            </div>

                        </div>
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

                                <span class="help-block">{{trans('profile.alter_user_bio_bottom')}}</span>

                                <div class="pull-right">

                                    {!! Form::submit('Добавить', array( 'class' => 'button button-default' )) !!}
                                </div>

                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
@stop
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
        //        $('#preamble').simplyCountable({
        //            counter:            '#counter2',
        //            countType:          'characters',
        //            maxCount:           300,
        //            strictMax:          true,
        //            countDirection:     'down',
        //            safeClass:          'safe',
        //            overClass:          'over',
        //            thousandSeparator:  ',',
        //            onOverCount:        function(count, countable, counter){},
        //            onSafeCount:        function(count, countable, counter){},
        //            onMaxCount:         function(count, countable, counter){}
        //        });
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
        $('.type-zone').attr('placeholder', 'at least one tag');
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
@endsection
@endif
