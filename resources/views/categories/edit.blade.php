@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Category $model */ @endphp
    <div class="content">
        <div class="form-wrap">
            <form action="{{ route('test.categories.store') }}" method="post" class="row">
                @csrf

                <div class="col-md-12">
                    <label for="name" class="form-label">{{ __('Category.Label.Name') }}</label>
                    <input type="text"
                           class="form-control @error('name') border-danger @enderror"
                           name="name"
                           placeholder="{{ __('Category.Placeholder.Name') }}"
                           id="name"
                           value="{{ old('name', $model->name) }}"
                    >
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">{{ __('Category.Button.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
