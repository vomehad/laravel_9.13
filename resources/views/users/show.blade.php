@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('users.edit', ['user' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('User.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('users.destroy', ['user' => $model->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('users.index') }}"
    >{{ __('User.Button.Delete') }}</button>

    <main role="main" class="container">
        <div class="starter-template">
            <p class="lead">{{ $model->content }}</p>
        </div>
    </main>
@endsection
