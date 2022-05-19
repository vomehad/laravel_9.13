@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\User $model */ @endphp
    <div class="content">
        <div class="form-wrap">
            <form action="{{ route('users.store') }}" method="post" class="row">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}" />

                <div class="col-md-12">
                    <label for="username" class="form-label">{{ __('User.Label.Username') }}</label>
                    <input type="text"
                           class="form-control @error('username') border-danger @enderror"
                           name="username"
                           placeholder="{{ __('User.Placeholder.Username') }}"
                           id="username"
                           value="{{ old('username', $model->username) }}"
                    >
                </div>
                @error('username')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="email" class="form-label">{{ __('User.Label.Email') }}</label>
                    <input type="text"
                           class="form-control @error('email') border-danger @enderror"
                           name="email"
                           placeholder="{{ __('User.Placeholder.Email') }}"
                           id="email"
                           value="{{ old('email', $model->email) }}"
                    >
                </div>
                @error('email')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">{{ __('User.Button.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
