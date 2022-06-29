@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Article $model */ @endphp
    <a href="{{ route('articles.edit', $model->id) }}"
       class="btn btn-primary"
    >{{ __('Article.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('articles.destroy', $model->id) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route("articles.index") }}"
    >{{ __('Article.Button.Delete') }}</button>

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-12 col-sm-0">
                @foreach($model->category as $category)
                    @php /** @var \App\Models\Category $category */ @endphp
                    <div class="badge badge-secondary">{{ $category->name }}</div>
                @endforeach
            </div>
        </div>

        <div class="starter-template">
            <span class="link"><a href="{{ $model->link }}">{{ $model->link }}</a></span>
            <div>{!! $model->text !!}</div>
        </div>
    </main>
@endsection
