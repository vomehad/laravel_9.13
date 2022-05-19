@extends('layouts.app')
@section('title', $title)
@section('content')
    <form action="{{ route('Login') }}" class="col-6 offset-2 border rounded" method="POST">

        @csrf

        <div class="form-group">
            <label for="email" class="col-form-label-lg">{{ trans('Auth.Label.Email') }}</label>
            <input type="email"
                   class="form-control @error('email') border-danger @enderror"
                   name="email"
                   id="email"
                   value=""
                   placeholder="{{ trans('Auth.Placeholder.Email') }}"
            />
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label-lg">{{ trans('Auth.Label.Password') }}</label>
            <input type="password"
                   class="form-control @error('password') border-danger @enderror"
                   name="password"
                   id="password"
                   value=""
                   placeholder="{{ trans('Auth.Placeholder.Password') }}"
            />
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary"
                    type="submit"
                    name="sendMe"
                    value="1"
            >{{ __('Auth.Send.Login') }}</button>
        </div>

    </form>
@endsection
