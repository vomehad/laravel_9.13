@extends('layouts.app')
@section('content')
    <div class="content">
        @foreach($models as $user)
            @php /** @var \App\Models\User $user */ @endphp
            <div class="btn btn-default">{{ $user->username }}</div>
            <div class="btn btn-default">{{ $user->email }}</div>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ __('User.Button.Update') }}</a>
            <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger">{{ __('User.Button.Delete') }}</a>
            <a href="{{ route('users.roles', $user->id) }}" class="btn btn-success">{{ __('User.Button.Roles') }}</a>
            <hr>
        @endforeach
    </div>
@endsection
