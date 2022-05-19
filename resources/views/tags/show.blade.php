@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Tag $model */ @endphp
    <a href="{{ route('tags.edit', $model->id) }}"
       class="btn btn-primary"
    >{{ __('Tag.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('tags.destroy', $model->id) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('tags.index') }}"
    >{{ __('Tag.Button.Delete') }}</button>

    <main role="main" class="container">
        <div class="starter-template">
            <p class="lead">{{ $model->description }}</p>
        </div>
    </main>
@endsection
