@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Tag $model */ @endphp
    <div class="content">
        <div class="form-wrap">
            <form action="{{ route('tags.store') }}" method="post" class="row">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}" />

                <div class="col-md-12">
                    <label for="name" class="form-label">{{ __('Tag.Label.Name') }}</label>
                    <input type="text"
                           class="form-control @error('name') border-danger @enderror"
                           name="name"
                           placeholder="{{ __('Tag.Placeholder.Name') }}"
                           id="name"
                           value="{{ old('name', $model->name) }}"
                    >
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="description" class="form-label">{{ __('Tag.Label.Description') }}</label>
                    <input type="text"
                           class="form-control @error('description') border-danger @enderror"
                           name="description"
                           placeholder="{{ __('Tag.Placeholder.Description') }}"
                           id="name"
                           value="{{ old('description', $model->description) }}"
                    >
                </div>
                @error('description')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">{{ __('Tag.Button.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
