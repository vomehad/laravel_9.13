@extends('layouts.app')
@section('content')
    @php
        /** @var \App\Models\Note $model */
        /** @var \App\Models\Note[] $parentNotes */
        /** @var \App\Models\Category $categories */
    @endphp
    <div class="note-content">
        <div class="form-wrap">
            <form action="{{ route('test.notes.store') }}" method="post" class="row">
                @csrf

                <div class="col-md-12">
                    <label for="name" class="form-label">{{ __('Note.Label.Name') }}</label>
                    <input name="name" value="{{ old('name', $model->name) }}"
                           type="text"
                           class="form-control @error('name') border-danger @enderror"
                           placeholder="{{ __('Note.Placeholder.Name') }}"
                           id="name"
                    >
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-10 col-sm-12">
                    <label for="select-category" class="multiselect_label"></label>
                    <input type="checkbox" id="select-category" class="multiselect_checkbox">

                    <label for="category-selector" class="field_multiselect">{{ __('Note.Label.Category') }}</label>
                    <select name="category[]" id="category-selector" class="field_select" multiple>
                        @foreach($categories as $category)
                            @php /** @var \App\Models\Category $category */ @endphp
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="error_text"></span>
                @error('category')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="note" class="form-label">{{ __('Note.Label.Parent') }}</label>
                    <select name="parent_id" id="note" class="@error('parent_id') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($parentNotes as $note)
                            @php /** @var \App\Models\Note $note */ @endphp
                            <option value="{{ $note->id }}">{{ $note->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('parent_id')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="content" class="form-label">{{ __('Note.Label.Content') }}</label>
                    <textarea name="content"
                              class="form-control @error('content') border-danger @enderror"
                              placeholder="{{ __('Note.Placeholder.Content') }}"
                              cols="30"
                              rows="10"
                              id="content"
                    >{{ old('content', $model->content) }}</textarea>
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
