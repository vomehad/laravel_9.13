@extends('layouts.app')
@section('content')
    <div class="control">
        <a href="{{ route('tags.create') }}" class="btn btn-success">{{ __('Tag.Button.Create') }}</a>
    </div>
    <div class="content">
        @foreach($models as $tag)
            @php /** @var \App\Models\Tag $tag */ @endphp
            <div class="btn btn-default">{{ $tag->name }}</div>
        @endforeach
    </div>
@endsection
