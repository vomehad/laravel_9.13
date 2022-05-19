@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Note $model */ @endphp
    <a href="{{ route('test.notes.edit', ['note' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('Note.Button.Update') }}</a>

    <button class="btn btn-danger js-delete"
            data-ref="{{ route('test.notes.destroy', ['note' => $model->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('test.notes.index') }}"
    >{{ __('Note.Button.Delete') }}</button>

    <main role="main" class="container">
        @if (session('success'))
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="starter-template">
            <p class="lead">{{ old('content', $model->content) }}</p>
        </div>

    </main>
@endsection
