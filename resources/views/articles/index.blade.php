@extends('layouts.app')
@section('content')
    <form class="input" action="{{ route('articles.search') }}" method="post">
        @csrf
        <div class="form-outline">
            <input type="search" name="search"
                   id="search-input"
                   class="form-control"
                   value="{{ $string ?? '' }}"
            />
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Article.Button.Search') }}</button>
    </form>

    <div class="control">
        <a href="{{ route('articles.create') }}"
           class="btn btn-success"
        >{{ __('Article.Button.Create') }}</a>
    </div>

    <div class="content">
        <span>{{ __('Article.Search') }} - {{ $models->total() }}</span>
        @foreach($models as $article)
            @php /** @var \App\Models\Article $article */ @endphp
            <div class="list-group">
                <a href="{{ route('articles.show', ['article' => $article->id]) }}"
                   class="list-group-item list-group-item-action flex-column align-items-start"
                   title="{{ $article->getPreview() }}"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $article->title }}</h5>
                        <small>{{ $article->updated_at }}</small>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{ $models->onEachSide(5)->links() }}
@endsection
