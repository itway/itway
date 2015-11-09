@if(!empty($user->picture()->get()->all()))
    <?php $picture = $user->picture()->get()->first()->path ?>
    {!! url('images/users/' . $picture) !!}
@else
    @if($user->photo)
        {!! $user->photo !!}
    @else
        {!!url('images/default-user.png')!!}
    @endif

@endif