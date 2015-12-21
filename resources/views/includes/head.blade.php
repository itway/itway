<!DOCTYPE html>
<html lang="{{\Illuminate\Support\Facades\Lang::getLocale()}}">
@section('meta_description')
@endsection
@section('meta_keywords')
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itway.io @yield('title')</title>
    <!-- Example Shares with description -->
    <meta name="description" content="@yield('meta-description')"/>
    <!-- Example Shares with Image -->
    <meta property="og:image" content="@yield('meta-image')"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @include('includes.styles')
</head>