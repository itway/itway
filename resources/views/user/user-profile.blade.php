
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

        <div style="padding:0">
@include('user.user-partial')
        </div>


@stop
@section('styles-add')
    @endsection
@section('scripts-add')
    @endsection
@endif
