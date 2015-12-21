
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

{{--{{dd($user)}}--}}
        <div style="padding:0">
@include('user.user-partial')
        </div>


@stop
@section('styles-add')
    {{--<link rel="stylesheet" href="{{asset('dist\components\tab.css')}}"/>--}}
    @endsection
@section('scripts-add')
    {{--<script src="{{asset('dist/components/tab.min.js')}}"></script>--}}
    <script>
//        $('.nav-tabs li a').tab();
    </script>
    @endsection
@endif
