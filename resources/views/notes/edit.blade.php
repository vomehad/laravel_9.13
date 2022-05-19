@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Note $model */ @endphp
    <div class="note-content">
        <div class="form-wrap">
            <form action="{{ route('test.notes.store') }}" method="post" class="row">
                @csrf

                <div class="col-md-12">
                    <label for="name" class="form-label">{{ __('Note.Label.Name') }}</label>
                    <input type="text"
                           class="form-control @error('name') border-danger @enderror"
                           name="name"
                           placeholder="{{ __('Note.Placeholder.Name') }}"
                           id="name"
                           value="{{ $model->name }}"
                    >
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="content" class="form-label">{{ __('Note.Label.Content') }}</label>
                    <textarea class="form-control @error('content') border-danger @enderror"
                              name="content"
                              placeholder="{{ __('Note.Placeholder.Content') }}"
                              id="content"
                              cols="30"
                              rows="10"
                    >{{ $model->content }}</textarea>
                </div>
                @error('content')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">{{ __('Note.Button.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
