@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="auth form-wrap">
    <form action="{{ route('Create') }}" class="col-6 offset-2 border rounded" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="col-form-label-lg">{{ __('Auth.Label.Name') }}</label>
            <input type="text"
                   class="form-control @error('email') border-danger @enderror"
                   name="email"
                   id="email"
                   placeholder="{{ __('Auth.Placeholder.Name') }}"
            />
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label-lg">{{ __('Auth.Label.Password') }}</label>
            <input type="password"
                   class="form-control @error('password') border-danger @enderror"
                   name="password"
                   id="password"
                   placeholder="{{ __('Auth.Placeholder.Password') }}"
            />
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="sendMe" value="1">{{ __('Auth.Send.Sign-up') }}</button>
        </div>

    </form>
    </div>
@endsection
