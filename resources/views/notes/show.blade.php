@extends('layouts.app')
@section('content')
    @php
        /** @var \App\Models\Note $model */
        /** @var \App\Models\Note[] $children */
     @endphp
    <div class="control">
        <a href="{{ route('test.notes.edit', ['note' => $model->id]) }}"
           class="btn btn-primary"
        >{{ __('Note.Button.Update') }}</a>
        <button class="btn btn-danger js-delete"
                data-ref="{{ route('test.notes.destroy', ['note' => $model->id]) }}"
                data-csrf="{{ csrf_token() }}"
                data-redirect="{{ route('test.notes.index') }}"
        >{{ __('Note.Button.Delete') }}</button>
        @if($model->parentNote->id)
        <a href="{{ route('test.notes.show', $model->parentNote->id) }}"
           class="btn btn-secondary"
        >{{ __('Note.Button.Parent') ." ". $model->parentNote->name }}</a>
        @endif
        <a href="{{ route('test.notes.index') }}"
           class="btn btn-success"
        >{{ __('Note.Button.List')}}</a>
    </div>

    <main role="main" class="container">
        @if (session('success'))
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        @foreach($model->category as $category)
            @php /** @var \App\Models\Category $category */ @endphp
            <div class="badge badge-secondary">{{ $category->name }}</div>
        @endforeach

        <div class="starter-template">
            <p class="lead">{{ old('content', $model->content) }}</p>
        </div>

        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Categories</td>
            </tr>
            </thead>
            <tbody>
            @foreach($children as $child)
                @php /** @var \App\Models\Note $child */ @endphp
                    <tr>
                        <td>
                            <a href="{{ route('test.notes.show', $child->id) }}"
                               class="btn btn-warning"
                            >{{ $child->name }}</a>
                        </td>
                        @foreach($child->category as $category)
                        <td class="btn btn-secondary badge">{{ $category->name }}</td>
                        @endforeach
                    </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
