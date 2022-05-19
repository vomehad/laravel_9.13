<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    @yield('meta')
{{--    <title>@yield('title')</title>--}}
    <title>{{ $title ?? __('Titles' . '.' . \App\Helpers\NameHelper::getActionName()) }}</title>
    @include('layouts.includes.assets.css')
    @include('layouts.includes.assets.fonts')
    @yield('head')
</head>
<body class="container body-content">
@include('layouts.includes.header')
<div class="container">
    @include('layouts.includes.assets.messages')
    <div class="row">
        <div class="col-bg-9 col-md-10 col-sm-12">
            @yield('content')
        </div>
        <div class="col-bg-3 col-md-2 col-sm-0">
            @include('layouts.includes.aside')
        </div>
    </div>
</div>
@include('layouts.includes.assets.js')
@include('layouts.includes.footer')
@yield('body')
</body>
</html>
