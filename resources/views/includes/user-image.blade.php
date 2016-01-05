@if(!empty($user->getMedia('logo')->first()))

    <?php    $pictures = $user->getMedia('logo');
    $picture = $pictures[0]->getUrl();
    ?>
    {!!url($picture)!!}
@else
        {!!url('images/default-user.png')!!}
@endif