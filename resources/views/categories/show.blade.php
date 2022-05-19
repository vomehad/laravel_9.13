@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Category $model */ @endphp
    <a href="{{ route('test.categories.edit', $model->id) }}"
       class="btn btn-primary"
    >{{ __('Category.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('test.categories.destroy', $model->id) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('test.categories.index') }}"
    >{{ __('Category.Button.Delete') }}</button>

    <main role="main" class="container">
        <div class="starter-template">
            <p class="lead">{{ $model->content }}</p>
        </div>
        <div class="">
{{--            @foreach()--}}
        </div>
    </main>
@endsection
