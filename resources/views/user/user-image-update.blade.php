
{!!Form::model($user, [ 'id' => 'changeImage' , 'class' => 'form', 'role' =>  'form','files' => true, 'route' => ['itway::user::photo']])!!}

<div class="blurring dimmable image">
    <div class="ui dimmer">
        <div class="content">
            <div class="center">
                <div class="ui inverted button">
                    <label class="label" for="file">
                        {{trans('profile.user_press_to_down')}}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <img class="profile-img" alt="{{$user->name}}" align="center"  title="{{$user->name}}" style="" src="@include('includes.user-image', $user)">
</div>
        <input type="text" readonly="" class="hidden" >
        <div class="clearfix"></div>

        {!! Form::file('photo', ['id' => 'file', 'class' => 'text-primary', 'placeholder' => 'insert your post image here      (max: 1 )',  'multiple'=>'false' , 'hidden']) !!}

<div class="clearfix"></div>
{!!Form::submit(trans('profile.user_download'), ['id' => 'upload-button','class' => 'button button-primary button-block hidden'])!!}
{!!Form::close()!!}