@extends('layouts.app')
@section('title', $title)
@section('content')
    <h1>{{ __('account.hello') }} {{ $title }}</h1>
@endsection
