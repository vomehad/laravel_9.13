@extends('layouts.app')
@section('meta')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection
@section('content')
    @php
        /** @var \App\Models\Article $model */
        /** @var array $selected */
    @endphp
    <div class="form-wrap">
        <form action="{{ route('articles.store') }}" method="post" class="row multiselect_block">
            @csrf
            <input type="hidden" name="id" value="{{ $model->id }}" />

            <div class="col-md-10 col-sm-12">
                <label for="title" class="form-label">{{ __('Article.Label.Title') }}</label>
                <input name="title" value="{{ old('title', $model->title) }}"
                       type="text"
                       class="form-control @error('title') border-danger @enderror"
                       placeholder="{{ __('Article.Placeholder.Title') }}"
                       id="title"
                >
            </div>
            @error('title')
            <div class="alert alert-danger">
                <span>{{ $message }}</span>
            </div>
            @enderror

                <div class="col-md-10 col-sm-12">
                    <label for="link">{{ __('Article.Label.Link') }}</label>
                    <input name="link" value="{{ old('link', $model->link) }}"
                           type="text"
                           class="form-control @error('link') border-danger @enderror"
                           placeholder="{{ __('Article.Placeholder.Link') }}"
                           id="link"
                    />
                </div>

                <div class="col-md-10 col-sm-12">
                    <label for="select-category" class="multiselect_label"></label>
                    <input type="checkbox" id="select-category" class="multiselect_checkbox">

                    <label for="category-selector" class="field_multiselect">{{ __('Article.Label.Category') }}</label>
                    <select name="category[]" id="category-selector" class="field_select" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ Arr::exists($selected, $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="error_text"></span>

            <div class="col-md-10 col-sm-12">
                <label for="text" class="form-label">{{ __('Article.Label.Text') }}</label>
                <textarea name="text"
                          class="form-control @error('text') is-invalid @enderror"
                          placeholder="{{ __('Article.Placeholder.Text') }}"
                          id="text"
                          rows="16"
                >{{ old('text', $model->text) }}</textarea>
            </div>
            @error('text')
            <div class="alert alert-danger">
                <span>{{ $message }}</span>
            </div>
            @enderror

            <div class="ml-5">
                <button type="submit" class="btn btn-success">{{ __('Article.Button.Save') }}</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $('#text').summernote({
            placeholder: 'Start writing an article here',
            tabsize: 2,
            height: 400
        });
    </script>
@endpush
