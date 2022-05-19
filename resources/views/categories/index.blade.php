@extends('layouts.app')
@section('content')
    <div class="control">
        <a href="{{ route('test.categories.create') }}"
           class="btn btn-success"
        >{{ __('Category.Button.Create') }}</a>
    </div>
    <div class="content">
        @foreach($models as $category)
            @php /** @var \App\Models\Category $category */ @endphp
            <div class="btn btn-default">{{ $category->name }}</div>
        @endforeach
    </div>
@endsection
